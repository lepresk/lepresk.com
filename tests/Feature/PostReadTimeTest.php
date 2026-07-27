<?php

declare(strict_types=1);

use App\Models\Post;

it('computes the read time when the field is left empty', function (): void {
    $post = Post::factory()->create([
        'content' => implode(' ', array_fill(0, 400, 'mot')),
        'read_time' => null,
    ]);

    expect($post->read_time)->toBe('2 min');
});

it('keeps a manually entered read time', function (): void {
    $post = Post::factory()->create([
        'content' => implode(' ', array_fill(0, 400, 'mot')),
        'read_time' => '30 min',
    ]);

    expect($post->read_time)->toBe('30 min');
});

it('recomputes the read time when the content changes', function (): void {
    $post = Post::factory()->create([
        'content' => implode(' ', array_fill(0, 400, 'mot')),
        'read_time' => null,
    ]);

    $post->update(['content' => implode(' ', array_fill(0, 1000, 'mot'))]);

    expect($post->fresh()->read_time)->toBe('5 min');
});

it('does not overwrite a manual read time when the content changes', function (): void {
    $post = Post::factory()->create([
        'content' => implode(' ', array_fill(0, 400, 'mot')),
        'read_time' => '30 min',
    ]);

    $post->update(['content' => implode(' ', array_fill(0, 1000, 'mot'))]);

    expect($post->fresh()->read_time)->toBe('30 min');
});

it('computes the read time from the filament create form', function (): void {
    $this->actingAs(App\Models\User::factory()->create());

    Livewire\Livewire::test(App\Filament\Resources\Posts\Pages\CreatePost::class)
        ->fillForm([
            'title' => 'Fingerprint Verification in ASP.NET Core',
            'slug' => 'fingerprint-verification-in-aspnet-core',
            'content' => implode(' ', array_fill(0, 1200, 'mot')),
            'status' => 'draft',
            'read_time' => null,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Post::query()->firstOrFail()->read_time)->toBe('6 min');
});
