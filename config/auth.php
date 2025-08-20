<?php

use App\Models\ExamUser;
use App\Models\User;

return [
    'defaults'         => [
        'guard'     => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards'           => [
        'web'  => [
            'driver'   => 'session',
            'provider' => 'users',
        ],

        'exam' => [
            'driver'   => 'session',
            'provider' => 'exam_users',
        ],
    ],

    'providers'        => [
        'users'      => [
            'driver' => 'eloquent',
            'model'  => env('AUTH_MODEL', User::class),
        ],

        'exam_users' => [
            'driver' => 'eloquent',
            'model'  => ExamUser::class,
        ],
    ],

    'passwords'        => [
        'users' => [
            'provider' => 'users',
            'table'    => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire'   => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];
