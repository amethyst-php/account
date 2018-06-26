<?php

return [

    'http' => [

        /*
        |--------------------------------------------------------------------------
        | Class name controller
        |--------------------------------------------------------------------------
        |
        | Here you may define the controller that will handle all the requests
        |
        */
        'controller' => Railken\LaraOre\Http\Controllers\AccountController::class,

        /*
        |--------------------------------------------------------------------------
        | Router Options
        |--------------------------------------------------------------------------
        |
        | Here you may define all the options that will be used by the route group
        |
        */
        'router' => [
            'prefix'      => '/account',
            'middleware'  => ['auth:api'],
        ],
    ],
];
