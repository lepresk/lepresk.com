<?php

declare(strict_types=1);

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

it('flushes post cache when a post is updated', function (): void {
    $post = Post::factory()->published()->create();

    Cache::put("post.slug:{$post->slug}", $post);
    Cache::put('blog.index.page:1', 'cached-index');

    $post->update(['title' => 'Updated Title']);

    expect(Cache::has("post.slug:{$post->slug}"))->toBeFalse()
        ->and(Cache::has('blog.index.page:1'))->toBeFalse();
});

it('flushes post cache when a post is created', function (): void {
    Cache::put('blog.index.page:1', 'cached-index');

    Post::factory()->published()->create();

    expect(Cache::has('blog.index.page:1'))->toBeFalse();
});

it('flushes post cache when a post is deleted', function (): void {
    $post = Post::factory()->published()->create();

    Cache::put("post.slug:{$post->slug}", $post);
    Cache::put('blog.index.page:1', 'cached-index');

    $post->delete();

    expect(Cache::has("post.slug:{$post->slug}"))->toBeFalse()
        ->and(Cache::has('blog.index.page:1'))->toBeFalse();
});
