<?php

namespace Railken\LaraOre\Account\Tests;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Support\Testing\ApiTestableTrait;

class ApiTest extends BaseTest
{
    use ApiTestableTrait;

    /**
     * Retrieve basic url.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return Config::get('ore.api.router.prefix').Config::get('ore.account.http.router.prefix');
    }

    /**
     * Test common requests.
     *
     * @return void
     */
    public function testAccount()
    {
        $response = $this->post(Config::get('ore.api.router.prefix').Config::get('ore.auth.http.router.prefix').'/sign-in', [
            'username' => 'admin@admin.com',
            'password' => 'vercingetorige',
        ]);
        $this->assertOrPrint($response, 200);

        $access_token = json_decode($response->getContent())->data->access_token;
        $this->withHeaders(['Authorization' => 'Bearer '.$access_token]);

        $response = $this->get($this->getBaseUrl());
        $this->assertOrPrint($response, 200);

        return $response;
    }
}
