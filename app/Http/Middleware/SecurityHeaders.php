<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Protection contre le clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Empêche le MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Politique de référence stricte
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Désactive les fonctionnalités inutiles du navigateur
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        // Force HTTPS (HSTS) - 1 an
        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        // Content Security Policy
        $csp = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.googletagmanager.com https://www.google-analytics.com",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
            "font-src 'self' https://fonts.gstatic.com",
            "img-src 'self' data: https:",
            "connect-src 'self' https://www.google-analytics.com",
            "frame-ancestors 'self'",
            "base-uri 'self'",
            "form-action 'self'",
        ];

        $response->headers->set('Content-Security-Policy', implode('; ', $csp));

        return $response;
    }
}
