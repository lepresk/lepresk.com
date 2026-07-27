<?php

declare(strict_types=1);

use App\Cache\BlogCache;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

it('flushes post cache when a post is updated', function (): void {
    $post = Post::factory()->published()->create();

    Cache::put(BlogCache::postKey('en', $post->slug), '<html>');
    Cache::put(BlogCache::indexKey('en', 1), '<html>');

    $post->update(['title' => 'Updated Title']);

    expect(Cache::has(BlogCache::postKey('en', $post->slug)))->toBeFalse()
        ->and(Cache::has(BlogCache::indexKey('en', 1)))->toBeFalse();
});

it('flushes post cache when a post is created', function (): void {
    Cache::put(BlogCache::indexKey('en', 1), '<html>');

    Post::factory()->published()->create();

    expect(Cache::has(BlogCache::indexKey('en', 1)))->toBeFalse();
});

it('flushes post cache when a post is deleted', function (): void {
    $post = Post::factory()->published()->create();

    Cache::put(BlogCache::postKey('en', $post->slug), '<html>');
    Cache::put(BlogCache::indexKey('en', 1), '<html>');

    $post->delete();

    expect(Cache::has(BlogCache::postKey('en', $post->slug)))->toBeFalse()
        ->and(Cache::has(BlogCache::indexKey('en', 1)))->toBeFalse();
});
