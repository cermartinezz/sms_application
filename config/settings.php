<?php

return [
    'settings' => [
        'db' => [
            'driver'    => 'mysql',
            'host'      => env("DB_HOST", 'localhost') ,
            'database'  => env("DB_DATABASE", 'sms_application') ,
            'username'  => env("DB_USERNAME", 'root') ,
            'password'  => env("DB_PASSWORD", ''),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
        'location' => [
            'region' => 'America/El_Salvador'
        ],
        'smtp' => [
            'type'      => env('MAILER_TYPE','smtp'),
            'host'      => env('MAILER_HOST','smtp.mailtrap.io'),
            'port'      => env('MAILER_PORT','2525'),
            'username'  => env('MAILER_USERNAME','my-username'),
            'password'  => env('MAILER_PASSWORD','my-secret-password'),
        ]
    ]
];
