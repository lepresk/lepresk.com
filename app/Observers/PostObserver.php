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
     */
    private function syncReadTime(Post $post): void
    {
        if (blank($post->content)) {
            return;
        }

        if (blank($post->read_time)) {
            $post->read_time = ($this->calculateReadTime)($post->content);

            return;
        }

        if (! $post->isDirty('content')) {
            return;
        }

        $previousContent = $post->getOriginal('content');

        if (is_string($previousContent) && $post->read_time === ($this->calculateReadTime)($previousContent)) {
            $post->read_time = ($this->calculateReadTime)($post->content);
        }
    }

    private function flushCache(Post $post): void
    {
        Cache::forget("post.slug:{$post->slug}");

        for ($i = 1; $i <= 20; $i++) {
            Cache::forget("blog.index.page:{$i}");
        }
    }
}
