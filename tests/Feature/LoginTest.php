<?php

namespace Tests\Feature;

use App\Mail\RegisterMail;
use App\Models\Skill;
use App\Models\User;
use Database\Seeders\SkillSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class LoginTest extends TestCase
{
    // use RefreshDatabase;

    public function test_login_attempt()
    {
        User::truncate();
        $this->post(route("register.new"), [
            'username' => "nourit",
            'email' => "reply.nourit@gmail.com",
            'password' => "0000",
        ]);
        $url = route("register.confirme", ['token' => User::first()->confirmation_token]);
        $this->get($url);

        $response = $this->post(route('login.attempt', [
            'email' => "reply.nourit@gmail.com",
            'password' => "0000",
        ]));
        $response->assertStatus(302);
    }
}
