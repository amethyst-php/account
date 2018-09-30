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
                'controller' => Railken\Amethyst\Http\Controllers\App\AccountController::class,
                'router'     => [
                    'prefix'      => '/account',
                    'middleware'  => ['auth:api'],
                ],
            ],
        ],
    ],
];
