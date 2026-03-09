<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Work;
use Illuminate\Http\Response;

final class SitemapController
{
    public function __invoke(): Response
    {
        $posts = Post::published()
            ->latestPublished()
            ->get(['slug', 'updated_at']);

        $projects = Work::published()
            ->ordered()
            ->get(['slug', 'updated_at']);

        $sitemap = view('sitemap', [
            'posts' => $posts,
            'projects' => $projects,
        ])->render();

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }
}
