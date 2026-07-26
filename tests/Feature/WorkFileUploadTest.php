<?php

declare(strict_types=1);

use App\Filament\Resources\Works\Pages\CreateWork;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function (): void {
    Storage::fake('public');
    Storage::fake('local');

    $this->actingAs(User::factory()->create());
});

it('stores the work featured image on the public disk', function (): void {
    Livewire::test(CreateWork::class)
        ->fillForm([
            'title' => 'Freeze',
            'slug' => 'freeze',
            'description' => 'Offline-first POS',
            'content' => 'Some content',
            'status' => 'draft',
            'order' => 0,
            'featured_image' => UploadedFile::fake()->image('freeze.png'),
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $work = Work::query()->firstOrFail();

    expect($work->featured_image)->toStartWith('works/featured-images/')
        ->and(Storage::disk('public')->exists($work->featured_image))->toBeTrue();
});

it('stores the work og image on the public disk', function (): void {
    Livewire::test(CreateWork::class)
        ->fillForm([
            'title' => 'Freeze',
            'slug' => 'freeze',
            'description' => 'Offline-first POS',
            'content' => 'Some content',
            'status' => 'draft',
            'order' => 0,
            'og_image' => UploadedFile::fake()->image('og.png'),
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $work = Work::query()->firstOrFail();

    expect($work->og_image)->toStartWith('works/og-images/')
        ->and(Storage::disk('public')->exists($work->og_image))->toBeTrue();
});

it('stores the work gallery images on the public disk', function (): void {
    Livewire::test(CreateWork::class)
        ->fillForm([
            'title' => 'Freeze',
            'slug' => 'freeze',
            'description' => 'Offline-first POS',
            'content' => 'Some content',
            'status' => 'draft',
            'order' => 0,
            'image_gallery' => [UploadedFile::fake()->image('gallery.png')],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $work = Work::query()->firstOrFail();

    expect($work->image_gallery)->toHaveCount(1);

    foreach ($work->image_gallery as $path) {
        expect($path)->toStartWith('works/galleries/')
            ->and(Storage::disk('public')->exists($path))->toBeTrue();
    }
});
