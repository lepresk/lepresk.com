<?php

declare(strict_types=1);

namespace App\Actions;

use App\Ai\Agents\ArticleMetadataTranslator;
use App\Ai\Agents\ArticleTranslator;
use App\Models\Post;
use Illuminate\Support\Str;
use Laravel\Ai\Responses\StructuredAgentResponse;
use RuntimeException;

final class TranslatePostToFrench
{
    /**
     * Short fields translated in a single structured call.
     *
     * @var array<int, string>
     */
    private const array METADATA_FIELDS = [
        'title',
        'excerpt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
    ];

    /**
     * Characters rule 8 of the prompt forbids, and their plain equivalents.
     *
     * @var array<string, string>
     */
    private const array FORBIDDEN_CHARACTERS = [
        "\u{2014}" => '-',
        "\u{2013}" => '-',
        "\u{2018}" => "'",
        "\u{2019}" => "'",
        "\u{201C}" => '"',
        "\u{201D}" => '"',
        "\u{2026}" => '...',
        "\u{00A0}" => ' ',
        "\u{202F}" => ' ',
    ];

    /**
     * A french URL nobody wants to read out loud starts around there.
     */
    private const int SLUG_MAX_LENGTH = 60;

    /**
     * Below that, an article is too short for the ratio to mean anything.
     */
    private const int MIN_PROSE_FOR_ACCENT_CHECK = 400;

    /**
     * French prose sits around 3 percent of accented letters.
     */
    private const float MIN_ACCENT_RATIO = 0.005;

    /**
     * Translate a post into French, leaving the source locale untouched.
     *
     * An existing french version is kept unless $overwrite is set, and its slug
     * survives a rewrite either way: the french URL may already be published and
     * indexed, so it is not silently replaced behind the reader's back.
     */
    public function __invoke(Post $post, bool $overwrite = false): Post
    {
        $locale = $this->sourceLocale();
        $existingSlug = $post->getTranslation('slug', 'fr', false);

        if (! $overwrite && $post->hasTranslation('content', 'fr')) {
            return $post;
        }

        $content = $post->getTranslation('content', $locale, false);

        if (! is_string($content) || $content === '') {
            throw new RuntimeException("This post has no {$locale} content to translate.");
        }

        $translatedContent = $this->clean((new ArticleTranslator)->prompt($content)->text);

        $this->assertImagesArePreserved($content, $translatedContent);
        $this->assertFrenchIsAccented($translatedContent);

        $metadata = $this->translateMetadata($post, $locale);

        $post->setTranslation('content', 'fr', $translatedContent);

        foreach ($metadata as $field => $value) {
            if ($field !== 'slug') {
                $post->setTranslation($field, 'fr', $value);
            }
        }

        $post->setTranslation('slug', 'fr', is_string($existingSlug) && $existingSlug !== ''
            ? $existingSlug
            : $this->availableSlug($metadata['slug'] ?? $metadata['title'], $post));

        $post->save();

        return $post;
    }

    /**
     * @return array<string, string>
     */
    private function translateMetadata(Post $post, string $locale): array
    {
        $source = [];

        foreach (self::METADATA_FIELDS as $field) {
            $value = $post->getTranslation($field, $locale, false);

            if (is_string($value) && $value !== '') {
                $source[$field] = $value;
            }
        }

        $response = (new ArticleMetadataTranslator)->prompt(
            "Translate the values of this JSON object into French:\n".json_encode($source, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
        );

        $data = $response instanceof StructuredAgentResponse ? $response->toArray() : [];

        $translated = [];

        foreach ([...array_keys($source), 'slug'] as $field) {
            $value = $data[$field] ?? null;

            if (is_string($value) && $value !== '') {
                $translated[$field] = $this->clean($value);
            }
        }

        if (! isset($translated['title'])) {
            throw new RuntimeException('The translated title came back empty.');
        }

        return $translated;
    }

    /**
     * Every image the source references must survive the translation.
     */
    private function assertImagesArePreserved(string $source, string $translation): void
    {
        $lost = array_diff($this->imageUrls($source), $this->imageUrls($translation));

        if ($lost !== []) {
            throw new RuntimeException('The translation dropped these images: '.implode(', ', $lost));
        }
    }

    /**
     * A french text of any length carries accents. Almost none means the model
     * stripped them, which is a misspelling of every second word, so the
     * translation is refused rather than published.
     *
     * Prose runs around three percent of accented letters; the floor here is six
     * times lower, low enough that a code heavy article stays clear of it.
     */
    private function assertFrenchIsAccented(string $translation): void
    {
        $prose = (string) preg_replace(['/```.*?```/su', '/`[^`]*`/u'], '', $translation);
        $length = mb_strlen($prose);

        if ($length < self::MIN_PROSE_FOR_ACCENT_CHECK) {
            return;
        }

        $accents = preg_match_all('/[\x{00C0}-\x{00FF}\x{0152}\x{0153}]/u', $prose);

        if ($accents / $length < self::MIN_ACCENT_RATIO) {
            throw new RuntimeException(
                "The translation came back with almost no accent ({$accents} for {$length} characters), so it is misspelled throughout.",
            );
        }
    }

    /**
     * @return array<int, string>
     */
    private function imageUrls(string $markdown): array
    {
        preg_match_all('/!\[[^\]]*\]\(\s*([^)\s]+)/', $markdown, $matches);

        return array_values(array_unique($matches[1]));
    }

    /**
     * The models slip on rule 8 often enough to be worth fixing here.
     */
    private function clean(string $value): string
    {
        return str_replace(
            array_keys(self::FORBIDDEN_CHARACTERS),
            array_values(self::FORBIDDEN_CHARACTERS),
            $value,
        );
    }

    /**
     * The model proposes the slug, this keeps it a valid and unique one.
     */
    private function availableSlug(string $candidate, Post $post): string
    {
        $base = Str::slug($this->withoutElidedParticles($candidate));

        if (mb_strlen($base) > self::SLUG_MAX_LENGTH) {
            $base = mb_strimwidth($base, 0, self::SLUG_MAX_LENGTH, '');
            $base = (string) preg_replace('/-[^-]*$/', '', $base);
        }

        $base = mb_trim($base, '-');

        if ($base === '') {
            $base = 'article-'.$post->id;
        }

        $slug = $base;
        $suffix = 1;

        while (Post::query()->whereKeyNot($post->getKey())->whereSlug($slug)->exists()) {
            $slug = $base.'-'.++$suffix;
        }

        return $slug;
    }

    /**
     * Without this, "Verification d'empreintes" slugs into "verification-dempreintes".
     */
    private function withoutElidedParticles(string $value): string
    {
        return (string) preg_replace('/\b(?:qu|[dlnjmtcs])[\x{2019}\']/iu', '', $value);
    }

    private function sourceLocale(): string
    {
        /** @var string $locale */
        $locale = config('app.fallback_locale', 'en');

        return $locale;
    }
}
