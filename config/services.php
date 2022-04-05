<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'telegram-bot-api' => [
        'bot_url' => env('TELEGRAM_BOT_URL'),
        'token' => env('TELEGRAM_BOT_TOKEN', 'YOUR BOT TOKEN HERE'),
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => 'http://localhost:8002/callback/google',
        'webhook_uri' => env('GOOGLE_WEBHOOK_URI'),
        'scopes' => [
            \Google_Service_Oauth2::USERINFO_EMAIL,
            \Google_Service_Calendar::CALENDAR,
        ],
        'approval_prompt' => 'force',
        'access_type' => 'offline',
        'include_granted_scopes' => true,
    ],

];
