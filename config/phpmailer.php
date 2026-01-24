<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PHPMailer Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer for sending emails.
    |
    | Supported: "phpmailer"
    |
    */
    'driver' => env('MAIL_DRIVER', 'phpmailer'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Host Address
    |--------------------------------------------------------------------------
    |
    | Here you may provide the host address of the SMTP server used by PHPMailer.
    |
    */
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Host Port
    |--------------------------------------------------------------------------
    |
    | This is the SMTP port used by PHPMailer to deliver emails.
    |
    */
    'port' => env('MAIL_PORT', 587),

    /*
    |--------------------------------------------------------------------------
    | Encryption Protocol
    |--------------------------------------------------------------------------
    |
    | Here you may specify the encryption protocol that should be used by PHPMailer.
    |
    | Supported: "ssl", "tls"
    |
    */
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Server Username
    |--------------------------------------------------------------------------
    |
    | If your SMTP server requires a username for authentication, you should
    | set it here. This will get used to authenticate with your server.
    |
    */
    'username' => env('MAIL_USERNAME'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Server Password
    |--------------------------------------------------------------------------
    |
    | Here you may provide the password required by your SMTP server.
    |
    */
    'password' => env('MAIL_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | From Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all emails sent by your application to be sent from
    | the same address. Here, you may specify a name and address that is
    | used globally for all emails that are sent by your application.
    |
    */
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Precise Diagnostics Imaging'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Reply To Address
    |--------------------------------------------------------------------------
    |
    | You may specify a default reply-to address for all emails.
    |
    */
    'reply_to' => [
        'address' => env('MAIL_REPLY_TO', 'support@precise-diagnostics.com'),
        'name' => env('MAIL_REPLY_TO_NAME', 'Support'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Debug Mode
    |--------------------------------------------------------------------------
    |
    | When debug mode is enabled, PHPMailer will display detailed error messages.
    | This is useful for debugging email configuration issues.
    |
    */
    'debug' => env('MAIL_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Debug Output
    |--------------------------------------------------------------------------
    |
    | Specifies the debug output mode.
    | Options: 'html', 'echo', 'error_log'
    |
    */
    'debug_output' => env('MAIL_DEBUG_OUTPUT', 'html'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Timeout
    |--------------------------------------------------------------------------
    |
    | Timeout in seconds for SMTP connection.
    |
    */
    'timeout' => env('MAIL_TIMEOUT', 30),

    /*
    |--------------------------------------------------------------------------
    | SMTP Keep Alive
    |--------------------------------------------------------------------------
    |
    | Enable SMTP keep alive (persistent connections).
    |
    */
    'keep_alive' => env('MAIL_KEEP_ALIVE', false),

    /*
    |--------------------------------------------------------------------------
    | SMTP Options
    |--------------------------------------------------------------------------
    |
    | Additional SMTP options for PHPMailer.
    |
    */
    'smtp_options' => [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ],
    ],
];