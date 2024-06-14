<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{

    public function test_login_attempt_with_valid_user()
    {
        $response = $this->post(route('login.attempt', [
            'email' => "reply.nourit@gmail.com",
            'password' => "0000",
        ]));
        $response->assertStatus(302);
    }
}
 