<?php

return [
    'default'     => 'main',
    'connections' => [
        'main'        => [
            'salt'     => env('HASHIDS_SALT', 'rexamnSuperSecretKey'),
            'length'   => env('HASHIDS_LENGTH', 16),
            'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
        ],
        'alternative' => [
            'salt'     => 'your-salt-string',
            'length'   => 8,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
        ],
    ],
];
