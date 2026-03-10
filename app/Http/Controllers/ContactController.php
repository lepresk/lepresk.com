<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

final class ContactController
{
    public function store(Request $request): JsonResponse
    {
        // Rate limiting: 3 attempts per minute per IP
        $key = 'contact-form:'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);

            return response()->json([
                'success' => false,
                'message' => __('Too many contact attempts. Please try again in :seconds seconds.', ['seconds' => $seconds]),
            ], 429);
        }

        /** @var array{name: string, email: string, subject: string, message: string} $validated */
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        try {
            Mail::to(config('contact.to'))
                ->cc(config('contact.cc'))
                ->send(new ContactFormMail($validated));

            RateLimiter::hit($key);

            return response()->json([
                'success' => true,
                'message' => __('Thank you for your message! We will get back to you soon.'),
            ]);
        } catch (Exception $e) {
            logger()->error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'email' => $validated['email'],
            ]);

            /** @var string $publicEmail */
            $publicEmail = config('contact.public_email');

            return response()->json([
                'success' => false,
                'message' => __('There was an error sending your message. Please try again later or contact us directly at :email', ['email' => $publicEmail]),
            ], 500);
        }
    }
}
