<?php

return [
    'default' => [
        'hostname' => env('DB_HOST', 'localhost'),
        'port' => 3306,
        'database' => env('DB_DATABASE'),
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),
        'tablepre' => env('DB_PREFIX', 'qm_'),
        'charset' => 'utf8',
        'type' => 'mysqli',
        'debug' => true,
        'pconnect' => 0,
        'autoconnect' => 0
    ],
];