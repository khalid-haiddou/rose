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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'cmi' => [
        'tpe' => env('CMI_TPE'),
        'secret' => env('CMI_SECRET_KEY'),
        'return_url' => env('CMI_RETURN_URL'),
        'success_url' => env('CMI_SUCCESS_URL'),
        'failure_url' => env('CMI_FAILURE_URL'),
        'gateway_url' => env('CMI_GATEWAY_URL'),
        'currency_code' => '504',
        'auto_redirect' => env('CMI_AUTO_REDIRECTION', true),
        'session_timeout' => 1800,
    ],
];
