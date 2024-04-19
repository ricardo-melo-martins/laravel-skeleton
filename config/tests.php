<?php

return [

    'enabled' => env('TESTS_ENABLED', false),

    'seed_data_fake' => env('TESTS_SEED_DATA_FAKE', false),

    /**
     * User mock for tests
     */
    'user' => [
        'username' => env('TESTS_USER_USERNAME'),
        'email' => env('TESTS_USER_EMAIL'),
        'password_hashed' => env('TESTS_USER_PASSWORD'),
        'password' => env('TESTS_USER_PASSWORD'),
    ],
];
