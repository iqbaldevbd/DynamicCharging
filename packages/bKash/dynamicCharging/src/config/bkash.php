<?php

return [
    'intent' => env('BKASH_INTENT', 'sale'),
    'payment_only' => [
        'sandbox' => env('BKASH_PWOA_SANDBOX', ''),
        'version' => env('BKASH_PWOA_VERSION', 'v1'),
        'app_key' => env('BKASH_PWOA_APP_KEY', ''),
        'app_secret' => env('BKASH_PWOA_APP_SECRET', ''),
        'username' => env('BKASH_PWOA_USER_NAME', ''),
        'password' => env('BKASH_PWOA_PASSWORD', ''),
    ]
];