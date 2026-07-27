<?php

declare(strict_types=1);

use App\Actions\TranslatePostToFrench;
use App\Ai\Agents\ArticleMetadataTranslator;
use App\Ai\Agents\ArticleTranslator;
use App\Models\Post;
use Laravel\Ai\Prompts\AgentPrompt;

function englishPost(array $overrides = []): Post
{
    $post = Post::factory()->create();

    $post->replaceTranslations('title', ['en' => 'Fingerprint verification']);
    $post->replaceTranslations('slug', ['en' => 'fingerprint-verification']);
    $post->replaceTranslations('excerpt', ['en' => 'A short excerpt.']);
    $post->replaceTranslations('content', ['en' => $overrides['content'] ?? "# Title\n\nThe english body."]);
    $post->replaceTranslations('meta_description', ['en' => 'The meta description.']);
    $post->save();

    return $post;
}

function fakeTranslations(string $content, array $metadata = []): void
{
    ArticleTranslator::fake([$content])->preventStrayPrompts();

    ArticleMetadataTranslator::fake([array_merge([
        'title' => 'Vérification d\'empreinte',
        'excerpt' => 'Un court extrait.',
        'meta_description' => 'La méta description.',
    ], $metadata)])->preventStrayPrompts();
}

it('stores the french translation without touching the english one', function (): void {
    $post = englishPost();
    fakeTranslations("# Titre\n\nLe contenu français.");

    (new TranslatePostToFrench)($post);

    $post->refresh();

    expect($post->getTranslation('content', 'fr'))->toBe("# Titre\n\nLe contenu français.")
        ->and($post->getTranslation('title', 'fr'))->toBe('Vérification d\'empreinte')
        ->and($post->getTranslation('excerpt', 'fr'))->toBe('Un court extrait.')
        ->and($post->getTranslation('content', 'en'))->toBe("# Title\n\nThe english body.")
        ->and($post->getTranslation('title', 'en'))->toBe('Fingerprint verification');
});

it('derives the french slug from the translated title', function (): void {
    $post = englishPost();
    fakeTranslations('Le contenu français.');

    (new TranslatePostToFrench)($post);

    expect($post->fresh()->getTranslation('slug', 'fr'))->toBe('verification-empreinte')
        ->and($post->fresh()->getTranslation('slug', 'en'))->toBe('fingerprint-verification');
});

it('suffixes the french slug when it is already taken', function (): void {
    $taken = Post::factory()->create();
    $taken->replaceTranslations('slug', ['fr' => 'verification-empreinte']);
    $taken->save();

    $post = englishPost();
    fakeTranslations('Le contenu français.');

    (new TranslatePostToFrench)($post);

    expect($post->fresh()->getTranslation('slug', 'fr'))->toBe('verification-empreinte-2');
});

it('keeps every image link of the source', function (): void {
    $post = englishPost(['content' => "Intro.\n\n![A chart](/storage/blog/chart.png)\n\n![Logo](/storage/blog/logo.svg)"]);
    fakeTranslations("Introduction.\n\n![Un graphique](/storage/blog/chart.png)\n\n![Logo](/storage/blog/logo.svg)");

    (new TranslatePostToFrench)($post);

    expect($post->fresh()->getTranslation('content', 'fr'))
        ->toContain('/storage/blog/chart.png')
        ->toContain('/storage/blog/logo.svg');
});

it('refuses a translation that dropped an image', function (): void {
    $post = englishPost(['content' => "Intro.\n\n![A chart](/storage/blog/chart.png)"]);
    fakeTranslations('Introduction, sans image.');

    expect(fn () => (new TranslatePostToFrench)($post))
        ->toThrow(RuntimeException::class, '/storage/blog/chart.png');

    expect($post->fresh()->hasTranslation('content', 'fr'))->toBeFalse();
});

it('replaces the typographic characters the prompt forbids', function (): void {
    $post = englishPost();
    fakeTranslations(
        "Le contenu \u{2014} avec des \u{201C}pièges\u{201D}\u{2026}",
        ['title' => "Vérification d\u{2019}empreinte"],
    );

    (new TranslatePostToFrench)($post);

    $post->refresh();

    expect($post->getTranslation('content', 'fr'))->toBe('Le contenu - avec des "pièges"...')
        ->and($post->getTranslation('title', 'fr'))->toBe("Vérification d'empreinte");
});

it('does not call the model when the post is already translated', function (): void {
    $post = englishPost();
    $post->setTranslation('content', 'fr', 'Déjà traduit.');
    $post->save();

    ArticleTranslator::fake();
    ArticleMetadataTranslator::fake();

    (new TranslatePostToFrench)($post);

    ArticleTranslator::assertNeverPrompted();
    ArticleMetadataTranslator::assertNeverPrompted();
});

it('sends the english content to the translator', function (): void {
    $post = englishPost();
    fakeTranslations('Le contenu français.');

    (new TranslatePostToFrench)($post);

    ArticleTranslator::assertPrompted(fn (AgentPrompt $prompt): bool => $prompt->contains('The english body.'));
});

it('offers the action only on posts without a french translation', function (): void {
    $this->actingAs(App\Models\User::factory()->create());

    $untranslated = englishPost();

    $translated = englishPost();
    $translated->replaceTranslations('slug', ['en' => 'already-translated']);
    $translated->setTranslation('content', 'fr', 'Déjà traduit.');
    $translated->save();

    Livewire\Livewire::test(App\Filament\Resources\Posts\Pages\ListPosts::class)
        ->assertTableActionVisible('translateToFrench', record: $untranslated)
        ->assertTableActionHidden('translateToFrench', record: $translated);
});

it('translates a post from the posts table', function (): void {
    $this->actingAs(App\Models\User::factory()->create());

    $post = englishPost();
    fakeTranslations('Le contenu français.');

    Livewire\Livewire::test(App\Filament\Resources\Posts\Pages\ListPosts::class)
        ->callTableAction('translateToFrench', record: $post)
        ->assertNotified();

    expect($post->fresh()->getTranslation('content', 'fr'))->toBe('Le contenu français.');
});

it('rewrites an existing french version when asked to', function (): void {
    $post = englishPost();
    $post->setTranslation('content', 'fr', 'Ancienne traduction.');
    $post->setTranslation('title', 'fr', 'Ancien titre');
    $post->setTranslation('slug', 'fr', 'ancien-slug');
    $post->save();

    fakeTranslations('Nouvelle traduction.');

    (new TranslatePostToFrench)($post, overwrite: true);

    $post->refresh();

    expect($post->getTranslation('content', 'fr'))->toBe('Nouvelle traduction.')
        ->and($post->getTranslation('title', 'fr'))->toBe('Vérification d\'empreinte')
        ->and($post->getTranslation('content', 'en'))->toBe("# Title\n\nThe english body.");
});

it('keeps the published french slug when rewriting', function (): void {
    $post = englishPost();
    $post->setTranslation('content', 'fr', 'Ancienne traduction.');
    $post->setTranslation('slug', 'fr', 'ancien-slug-deja-indexe');
    $post->save();

    fakeTranslations('Nouvelle traduction.');

    (new TranslatePostToFrench)($post, overwrite: true);

    expect($post->fresh()->getTranslation('slug', 'fr'))->toBe('ancien-slug-deja-indexe');
});

it('offers the rewrite action only on posts that already have a french version', function (): void {
    $this->actingAs(App\Models\User::factory()->create());

    $untranslated = englishPost();

    $translated = englishPost();
    $translated->replaceTranslations('slug', ['en' => 'already-translated']);
    $translated->setTranslation('content', 'fr', 'Déjà traduit.');
    $translated->save();

    Livewire\Livewire::test(App\Filament\Resources\Posts\Pages\ListPosts::class)
        ->assertTableActionHidden('retranslateToFrench', record: $untranslated)
        ->assertTableActionVisible('retranslateToFrench', record: $translated);
});

it('rewrites the french version from the posts table', function (): void {
    $this->actingAs(App\Models\User::factory()->create());

    $post = englishPost();
    $post->setTranslation('content', 'fr', 'Ancienne traduction.');
    $post->setTranslation('slug', 'fr', 'ancien-slug');
    $post->save();

    fakeTranslations('Nouvelle traduction.');

    Livewire\Livewire::test(App\Filament\Resources\Posts\Pages\ListPosts::class)
        ->callTableAction('retranslateToFrench', record: $post)
        ->assertNotified();

    expect($post->fresh()->getTranslation('content', 'fr'))->toBe('Nouvelle traduction.');
});

it('uses the slug proposed by the model rather than the translated title', function (): void {
    $post = englishPost();
    fakeTranslations('Le contenu français.', [
        'title' => 'Vérification d\'empreintes digitales en ASP.NET Core avec SourceAFIS (correspondance 1:1)',
        'slug' => 'verification-empreintes-aspnet-core-sourceafis',
    ]);

    (new TranslatePostToFrench)($post);

    expect($post->fresh()->getTranslation('slug', 'fr'))->toBe('verification-empreintes-aspnet-core-sourceafis');
});

it('caps an overlong slug on a word boundary', function (): void {
    $post = englishPost();
    fakeTranslations('Le contenu français.', [
        'slug' => 'verification-empreintes-digitales-en-aspnet-core-avec-sourceafis-correspondance-11',
    ]);

    (new TranslatePostToFrench)($post);

    $slug = $post->fresh()->getTranslation('slug', 'fr');

    expect(mb_strlen($slug))->toBeLessThanOrEqual(60)
        ->and($slug)->not->toEndWith('-')
        ->and($slug)->toBe('verification-empreintes-digitales-en-aspnet-core-avec');
});

it('drops elided particles instead of gluing them to the next word', function (): void {
    $post = englishPost();
    fakeTranslations('Le contenu français.', [
        'title' => "Vérification d'empreintes",
        'slug' => "vérification d'empreintes digitales",
    ]);

    (new TranslatePostToFrench)($post);

    expect($post->fresh()->getTranslation('slug', 'fr'))->toBe('verification-empreintes-digitales');
});

it('falls back on the translated title when the model returns no slug', function (): void {
    $post = englishPost();
    ArticleTranslator::fake(['Le contenu français.'])->preventStrayPrompts();
    ArticleMetadataTranslator::fake([['title' => 'Un titre français']])->preventStrayPrompts();

    (new TranslatePostToFrench)($post);

    expect($post->fresh()->getTranslation('slug', 'fr'))->toBe('un-titre-francais');
});

it('refuses a translation that came back without accents', function (): void {
    $post = englishPost(['content' => str_repeat('Some english source sentence. ', 30)]);

    fakeTranslations(str_repeat('Le probleme, c est que les equipes ne se rendent pas compte. ', 20));

    expect(fn () => (new TranslatePostToFrench)($post))
        ->toThrow(RuntimeException::class, 'almost no accent');

    expect($post->fresh()->hasTranslation('content', 'fr'))->toBeFalse();
});

it('accepts a properly accented translation', function (): void {
    $post = englishPost(['content' => str_repeat('Some english source sentence. ', 30)]);

    fakeTranslations(str_repeat('Le problème, c\'est que les équipes ne s\'en rendent pas compte. ', 20));

    (new TranslatePostToFrench)($post);

    expect($post->fresh()->hasTranslation('content', 'fr'))->toBeTrue();
});

it('does not judge a short translation on its accents', function (): void {
    $post = englishPost(['content' => 'Short source.']);

    fakeTranslations('Source courte.');

    (new TranslatePostToFrench)($post);

    expect($post->fresh()->getTranslation('content', 'fr'))->toBe('Source courte.');
});
