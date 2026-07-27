<?php

declare(strict_types=1);

namespace App\Observers;

use App\Actions\CalculateReadTime;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

final class PostObserver
{
    public function __construct(private CalculateReadTime $calculateReadTime) {}

    public function saving(Post $post): void
    {
        $this->syncReadTime($post);
    }

    public function saved(Post $post): void
    {
        $this->flushCache($post);
    }

    public function deleted(Post $post): void
    {
        $this->flushCache($post);
    }

    /**
     * Fill the read time from the content, unless it was entered by hand.
     *
     * The content is translatable, so the read time is derived from the
     * fallback locale, which is the one every post is guaranteed to have.
     */
    private function syncReadTime(Post $post): void
    {
        $content = $post->getTranslation('content', $this->fallbackLocale(), false);

        if (! is_string($content) || $content === '') {
            return;
        }

        if (blank($post->read_time)) {
            $post->read_time = ($this->calculateReadTime)($content);

            return;
        }

        if (! $post->isDirty('content')) {
            return;
        }

        $previousContent = $this->originalTranslation($post, 'content');

        if ($previousContent !== null && $post->read_time === ($this->calculateReadTime)($previousContent)) {
            $post->read_time = ($this->calculateReadTime)($content);
        }
    }

    /**
     * Read a translation as it was stored before the current changes.
     */
    private function originalTranslation(Post $post, string $key): ?string
    {
        $original = $post->getOriginal($key);

        if (is_string($original)) {
            $decoded = json_decode($original, true);
            $original = is_array($decoded) ? $decoded : [$this->fallbackLocale() => $original];
        }

        if (! is_array($original)) {
            return null;
        }

        $value = $original[$this->fallbackLocale()] ?? null;

        return is_string($value) ? $value : null;
    }

    private function fallbackLocale(): string
    {
        /** @var string $locale */
        $locale = config('app.fallback_locale', 'en');

        return $locale;
    }

    private function flushCache(Post $post): void
    {
        foreach ($post->slugsInAllLocales() as $slug) {
            Cache::forget("post.slug:{$slug}");
        }

        for ($i = 1; $i <= 20; $i++) {
            Cache::forget("blog.index.page:{$i}");
        }
    }
}
