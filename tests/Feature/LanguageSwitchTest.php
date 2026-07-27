<?php

declare(strict_types=1);

use App\Models\Post;

it('switches the language without a token, so a cached page keeps working', function (): void {
    $response = $this->get(route('language.switch', 'fr'));

    $response->assertRedirect()->assertCookie('locale', 'fr');
});

it('rejects a locale it does not know', function (): void {
    // The route constraint answers first, the controller guard is the second line.
    $this->get('/language/de')->assertNotFound();
});

it('never caches a blog page in a shared cache', function (): void {
    $post = Post::factory()->published()->create();

    foreach ([route('blog.index'), route('blog.show', $post->slug)] as $url) {
        $response = $this->get($url);

        expect($response->headers->get('Cache-Control'))
            ->toContain('private')
            ->not->toContain('public')
            ->and($response->headers->get('Vary'))->toContain('Cookie');
    }
});

it('renders the expired page with the site layout', function (): void {
    $rendered = view('errors.419')->render();

    expect($rendered)->toContain('419')
        ->and($rendered)->toContain(__('error.419.heading'))
        ->and($rendered)->toContain(__('error.419.reload'));
});
