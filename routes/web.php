<?php

declare(strict_types=1);

use App\Http\Controllers\LanguageController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', fn (): View => view('index'));

// Blog routes
Route::get('/blog', fn (): View => view('blog.index'));
Route::get('/blog/{slug}', fn (string $slug): View => view('blog.show', ['slug' => $slug]));

// Project routes
Route::get('/projets/{slug}', fn (string $slug): View => view('projects.show', ['slug' => $slug]));

// Contact form
Route::post('/contact', function () {
    // TODO: Implement contact form handling
    return redirect('/')->with('success', 'Message envoyé avec succès!');
});

// Language switching
Route::post('/language/{locale}', [LanguageController::class, 'switch'])
    ->name('language.switch')
    ->where('locale', 'en|fr');
