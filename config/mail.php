<?php

return [
    'default' => env('MAIL_DRIVER', 'phpmailer'),
    
    'mailers' => [
        'phpmailer' => [
            'transport' => 'phpmailer',
            'host' => env('MAIL_HOST', 'smtp.gmail.com'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => 30,
            'debug' => env('APP_DEBUG', false),
        ],
        
        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],
    ],

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', env('APP_NAME')),
    ],

    'reply_to' => env('MAIL_REPLY_TO'),
];