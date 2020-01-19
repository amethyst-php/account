<?php

namespace Amethyst\Providers;

use Amethyst\Core\Support\Router;
use Amethyst\Core\Providers\CommonServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

class AccountServiceProvider extends CommonServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->register(\Laravel\Passport\PassportServiceProvider::class);
        $this->app->register(\Amethyst\Providers\UserServiceProvider::class);
        $this->app->register(\Amethyst\Providers\AuthenticationServiceProvider::class);

        parent::register();
    }

    /**
     * Load routes.
     */
    public function loadRoutes()
    {
        $config = Config::get('amethyst.account.http.app.account');

        Router::group('app', Arr::get($config, 'router'), function ($router) use ($config) {
            $controller = Arr::get($config, 'controller');
            $router->get('/', ['as' => 'show', 'uses' => $controller.'@index']);
        });
    }
}
