<?php

declare(strict_types=1);

use App\Models\Work;

it('opens the lightbox, navigates between images and closes it', function (): void {
    $work = Work::factory()->published()->create([
        'slug' => 'lightbox-demo',
        'image_gallery' => [
            'works/galleries/one.png',
            'works/galleries/two.png',
            'works/galleries/three.png',
        ],
    ]);

    $page = visit(route('projects.show', $work->slug));

    $page->assertNoJavaScriptErrors()
        ->assertDontSee('1 / 3')
        ->click('[data-lightbox-index="0"]')
        ->assertVisible('[data-lightbox-overlay]')
        ->assertSee('1 / 3')
        ->click('[data-lightbox-next]')
        ->assertSee('2 / 3')
        ->click('[data-lightbox-prev]')
        ->assertSee('1 / 3')
        ->click('[data-lightbox-close]')
        ->assertDontSee('1 / 3')
        ->assertNoJavaScriptErrors();
});

it('navigates and closes the lightbox with the keyboard', function (): void {
    $work = Work::factory()->published()->create([
        'slug' => 'lightbox-keyboard-demo',
        'image_gallery' => [
            'works/galleries/one.png',
            'works/galleries/two.png',
            'works/galleries/three.png',
        ],
    ]);

    $page = visit(route('projects.show', $work->slug));

    $page->click('[data-lightbox-index="1"]')
        ->assertSee('2 / 3')
        ->keys('[data-lightbox-overlay]', ['ArrowRight'])
        ->assertSee('3 / 3')
        ->keys('[data-lightbox-overlay]', ['ArrowRight'])
        ->assertSee('1 / 3')
        ->keys('[data-lightbox-overlay]', ['ArrowLeft'])
        ->assertSee('3 / 3')
        ->keys('[data-lightbox-overlay]', ['Escape'])
        ->assertDontSee('3 / 3')
        ->assertNoJavaScriptErrors();
});
