<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{

    public function test_login_attempt_with_valid_user(): void
    {
        $response = $this->post(route('login.attempt', [
            'email' => env("MAIL_FROM_ADDRESS"),
            'password' => env("PASSWORD "),
        ]));
        $response->assertStatus(302);
    }

    public function test_render_login_page(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    public function test_render_login_page_with_logged_user(): void
    {
        Auth::login(User::first());
        $response = $this->get(route('login'));
        $response->assertStatus(302);
    }
}
