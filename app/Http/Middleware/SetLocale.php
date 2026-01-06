<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

final class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check cookie first (highest priority)
        $locale = $request->cookie('locale');

        // 2. Fallback to browser language if cookie doesn't exist
        if (! $locale) {
            $browserLang = mb_substr($request->server('HTTP_ACCEPT_LANGUAGE') ?? '', 0, 2);
            $locale = in_array($browserLang, ['en', 'fr']) ? $browserLang : 'en';
        }

        // 3. Set application locale
        App::setLocale($locale);

        return $next($request);
    }
}
