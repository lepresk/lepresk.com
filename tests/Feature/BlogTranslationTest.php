<?php

declare(strict_types=1);

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

function translatedPost(): Post
{
    $post = Post::factory()->published()->create();

    $post->replaceTranslations('title', ['en' => 'Fingerprint verification', 'fr' => 'Vérification d\'empreinte']);
    $post->replaceTranslations('slug', ['en' => 'fingerprint-verification', 'fr' => 'verification-empreinte']);
    $post->replaceTranslations('content', ['en' => 'The english body.', 'fr' => 'Le contenu français.']);
    $post->save();

    return $post;
}

it('serves a post from its slug in any locale', function (string $slug): void {
    translatedPost();

    $this->get("/blog/{$slug}")->assertOk();
})->with([
    'english slug' => 'fingerprint-verification',
    'french slug' => 'verification-empreinte',
]);

it('renders the post in the locale asked for, whichever slug was used', function (): void {
    translatedPost();

    $this->get('/blog/fingerprint-verification?lang=fr')
        ->assertOk()
        ->assertSee('Le contenu français.', escape: false)
        ->assertDontSee('The english body.', escape: false);

    $this->get('/blog/verification-empreinte?lang=en')
        ->assertOk()
        ->assertSee('The english body.', escape: false)
        ->assertDontSee('Le contenu français.', escape: false);
});

it('falls back to the default locale when a post is not translated', function (): void {
    $post = Post::factory()->published()->create();
    $post->replaceTranslations('title', ['en' => 'English only']);
    $post->replaceTranslations('slug', ['en' => 'english-only']);
    $post->replaceTranslations('content', ['en' => 'The english body.']);
    $post->save();

    $this->get('/blog/english-only?lang=fr')
        ->assertOk()
        ->assertSee('English only', escape: false);
});

it('advertises one alternate per translated locale', function (): void {
    translatedPost();

    $this->get('/blog/fingerprint-verification')
        ->assertOk()
        ->assertSee('hreflang="en"', escape: false)
        ->assertSee('hreflang="fr"', escape: false)
        ->assertSee('/blog/verification-empreinte?lang=fr', escape: false);
});

it('does not advertise an alternate for a missing translation', function (): void {
    $post = Post::factory()->published()->create();
    $post->replaceTranslations('title', ['en' => 'English only']);
    $post->replaceTranslations('slug', ['en' => 'english-only']);
    $post->replaceTranslations('content', ['en' => 'The english body.']);
    $post->save();

    $this->get('/blog/english-only')
        ->assertOk()
        ->assertSee('hreflang="en"', escape: false)
        ->assertDontSee('hreflang="fr"', escape: false);
});

it('lists every translated slug in the sitemap', function (): void {
    translatedPost();

    $this->get('/sitemap.xml')
        ->assertOk()
        ->assertSee('/blog/fingerprint-verification?lang=en', escape: false)
        ->assertSee('/blog/verification-empreinte?lang=fr', escape: false);
});

it('flushes the cache of every slug of a post', function (): void {
    $post = translatedPost();

    Cache::put('post.slug:fingerprint-verification', $post);
    Cache::put('post.slug:verification-empreinte', $post);

    $post->update(['status' => 'draft']);

    expect(Cache::has('post.slug:fingerprint-verification'))->toBeFalse()
        ->and(Cache::has('post.slug:verification-empreinte'))->toBeFalse();
});

it('returns a 404 for an unknown slug', function (): void {
    translatedPost();

    $this->get('/blog/does-not-exist')->assertNotFound();
});
