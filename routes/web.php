<?php

declare(strict_types=1);

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\WorkController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', fn (): View => view('index'));

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/preview/{id}', [BlogController::class, 'preview'])->name('blog.preview');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Project routes
Route::get('/projets/{slug}', [WorkController::class, 'show'])->name('projects.show');

// Contact form
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Language switching
Route::get('/language/{locale}', [LanguageController::class, 'switch'])
    ->name('language.switch')
    ->where('locale', 'en|fr');

// Sitemap
Route::get('/sitemap.xml', SitemapController::class);
