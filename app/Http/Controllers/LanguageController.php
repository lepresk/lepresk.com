<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

final class LanguageController
{
    /**
     * Switch the application language.
     */
    public function switch(string $locale): RedirectResponse
    {
        if (! in_array($locale, ['en', 'fr'])) {
            abort(400);
        }

        return redirect()->back()
            ->withCookie(cookie('locale', $locale, 525600)); // 1 year
    }
}
