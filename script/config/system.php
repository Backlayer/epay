<?php

return [
    'default' => [
        'locale' => env('DEFAULT_LANG', config('app.locale'))
    ],
    'queue' => [
        'mail' => env('QUEUE_MAIL', false)
    ],
    'kyc_verification' => env('KYC_VERIFICATION', false),
    'unescaped' => env('CONTENT_EDITOR', true),
    'notification_send_to_email' => env('NOTIFICATION_SEND_TO_EMAIL', false),
];
