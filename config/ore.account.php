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
            'enabled'    => true,
            'controller' => Railken\LaraOre\Http\Controllers\AccountController::class,
            'router'     => [
                'prefix'      => '/account',
                'middleware'  => ['auth:api'],
            ],
        ],
    ],
];
