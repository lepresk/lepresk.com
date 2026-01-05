<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;

final class BlogController
{
    public function index(): View
    {
        $posts = Post::published()
            ->with(['categories', 'tags'])
            ->latest()
            ->paginate(12);

        return view('blog.index', compact('posts'));
    }

    public function show(string $slug): View
    {
        $post = Post::published()
            ->with(['categories', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('blog.show', compact('post'));
    }
}
