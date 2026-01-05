<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Contracts\View\View;

final class WorkController
{
    public function show(string $slug): View
    {
        $work = Work::published()
            ->with(['categories', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('projects.show', compact('work'));
    }
}
