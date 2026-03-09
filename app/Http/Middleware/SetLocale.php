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
        /** @var array<int, string> $available */
        $available = config('app.available_locales', []);

        /** @var string|null $locale */
        $locale = $request->query('lang');

        if (! is_string($locale) || ! in_array($locale, $available, true)) {
            /** @var string|null $locale */
            $locale = $request->cookie('locale');
        }

        if (! is_string($locale) || ! in_array($locale, $available, true)) {
            /** @var string $acceptLang */
            $acceptLang = $request->server('HTTP_ACCEPT_LANGUAGE', '');
            $browserLang = mb_substr($acceptLang, 0, 2);
            /** @var string $fallback */
            $fallback = config('app.fallback_locale', 'en');
            $locale = in_array($browserLang, $available, true) ? $browserLang : $fallback;
        }

        App::setLocale($locale);

        /** @var Response $response */
        $response = $next($request);

        return $response;
    }
}
