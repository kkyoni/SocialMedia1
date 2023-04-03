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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', '3444828689104298'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', '1bfe8a3e067c084ac17420e21dc55e52'),
        'redirect' => env('FACEBOOK_REDIRECT', 'http://127.0.0.1:8000/facebook/callback'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', '460760850623-91bael204ffk7a2as00tn6lihm7v94so.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', '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'),
        'redirect' => env('GOOGLE_REDIRECT', 'http://127.0.0.1:8000/google/callback'),
    ],

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID', '7ebef3ac3712e9ac74fc'),
        'client_secret' => env('GITHUB_CLIENT_SECRET', '5bd21a728eebf095b5852a6c141eb08258dfa872'),
        'redirect' => env('GITHUB_REDIRECT', 'http://127.0.0.1:8000/github/callback'),
    ],

    'linkedin' => [
        'client_id' => env('LINKEDIN_CLIENT_ID', '86zf7haryxkmgg'),
        'client_secret' => env('LINKEDIN_CLIENT_SECRET', '1x9N6fMS2tll8Ebb'),
        'redirect' => env('LINKEDIN_REDIRECT', 'http://127.0.0.1:8000/linkedin/callback'),
    ],

    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID', 'xxxxxxxxxxxx'),
        'client_secret' => env('TWITTER_CLIENT_SECRET', 'xxxxxxxxxxxx'),
        'redirect' => env('TWITTER_REDIRECT', 'http://127.0.0.1:8000/twitter/callback'),
    ],
];
