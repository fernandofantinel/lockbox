<?php

return [
    'database' => [
        'driver' => 'sqlite',
        'database' => base_path('database/database.sqlite'),
    ],
    'security' => [
        'first_key' => env('ENCRYPT_FIRST_KEY', base64_encode('default_first_key')),
        'second_key' => env('ENCRYPT_SECOND_KEY', base64_decode('default_second_key')),
    ],
];
