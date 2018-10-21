<?php

namespace Railken\Amethyst\Tests;

class ApiTest extends BaseTest
{
    /**
     * Test common requests.
     */
    public function testAccount()
    {
        $response = $this->post(route('app.auth.basic'), [
            'username' => 'admin@admin.com',
            'password' => 'vercingetorige',
        ]);
        $response->assertStatus(200);

        $access_token = json_decode($response->getContent())->data->access_token;
        $this->withHeaders(['Authorization' => 'Bearer '.$access_token]);

        $response = $this->get(route('app.account.show'));
        $response->assertStatus(200);

        return $response;
    }
}
