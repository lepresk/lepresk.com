<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Contact Email Addresses
    |--------------------------------------------------------------------------
    |
    | These addresses are used by the contact form to send and receive
    | messages. They should be configured via environment variables.
    |
    */

    'to' => env('CONTACT_TO_EMAIL'),

    'cc' => env('CONTACT_CC_EMAIL'),

    'from' => [
        'address' => env('CONTACT_FROM_EMAIL', 'no-reply@lepresk.com'),
        'name' => env('CONTACT_FROM_NAME', 'Lepresk Contact Form'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Email
    |--------------------------------------------------------------------------
    |
    | The email address allowed to access the Filament admin panel.
    |
    */

    'admin_email' => env('ADMIN_EMAIL'),

    /*
    |--------------------------------------------------------------------------
    | Public Contact Info
    |--------------------------------------------------------------------------
    |
    | Contact information displayed publicly on the website.
    |
    */

    'public_email' => env('CONTACT_PUBLIC_EMAIL'),

    'public_phone' => env('CONTACT_PUBLIC_PHONE'),

];
