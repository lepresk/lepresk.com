<?php

declare(strict_types=1);

use App\Models\Work;

it('renders the gallery images as lightbox triggers', function (): void {
    $work = Work::factory()->published()->create([
        'image_gallery' => [
            'works/galleries/one.png',
            'works/galleries/two.png',
            'works/galleries/three.png',
        ],
    ]);

    $response = $this->get(route('projects.show', $work->slug));

    $response->assertOk()
        ->assertSee('data-lightbox-gallery', escape: false)
        ->assertSee('data-lightbox-item', escape: false)
        ->assertSee('/storage/works/galleries/one.png', escape: false)
        ->assertSee('/storage/works/galleries/two.png', escape: false)
        ->assertSee('/storage/works/galleries/three.png', escape: false)
        ->assertSee('data-lightbox-overlay', escape: false);

    expect(mb_substr_count($response->getContent(), 'data-lightbox-item'))->toBe(3);
});

it('does not render the gallery or the lightbox when the work has no gallery', function (): void {
    $work = Work::factory()->published()->create([
        'image_gallery' => null,
    ]);

    $this->get(route('projects.show', $work->slug))
        ->assertOk()
        ->assertDontSee('data-lightbox-gallery', escape: false)
        ->assertDontSee('data-lightbox-overlay', escape: false);
});
