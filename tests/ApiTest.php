<?php

namespace Railken\Amethyst\Tests;

use Illuminate\Support\Facades\Config;

class ApiTest extends BaseTest
{
    /**
     * Test common requests.
     */
    public function testAccount()
    {
        $response = $this->post(Config::get('amethyst.api.http.app.router.prefix').Config::get('amethyst.authentication.http.app.authentication.router.prefix'), [
            'username' => 'admin@admin.com',
            'password' => 'vercingetorige',
        ]);
        $response->assertStatus(200);

        $access_token = json_decode($response->getContent())->data->access_token;
        $this->withHeaders(['Authorization' => 'Bearer '.$access_token]);

        $response = $this->get(Config::get('amethyst.api.http.app.router.prefix').Config::get('amethyst.account.http.app.account.router.prefix'));
        $response->assertStatus(200);

        return $response;
    }
}
