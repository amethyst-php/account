<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Http configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the routes
    |
    */
    'http' => [
        'app' => [
            'account' => [
                'enabled'    => true,
                'controller' => Amethyst\Http\Controllers\App\AccountController::class,
                'router'     => [
                    'prefix'     => '/account',
                    'as'         => 'account.',
                    'middleware' => ['auth:api'],
                ],
            ],
        ],
    ],
];
