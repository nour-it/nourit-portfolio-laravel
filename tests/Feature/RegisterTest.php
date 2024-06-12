<?php

namespace Tests\Feature;

use App\Mail\RegisterMail;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Database\Seeders\SkillSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_send_mail_to_user()
    {
        $response = $this->post(route("register.new"), [
            'username' => "nourit4",
            'email' => "reply4.nourit@gmail.com",
            'password' => "0000",
        ]);
        Mail::fake();
        Mail::assertSent(RegisterMail::class);
        $response->assertStatus(302);
    }

    public function test_cofirme_user()
    {
        $this->refreshDatabase();
        $response = $this->post(route("register.new"), [
            'username' => "nourit3",
            'email' => "reply3.nourit@gmail.com",
            'password' => "0000",
        ]);
        $response->assertStatus(302);
        $url = route("register.confirme", ['token' => User::where('username', "nourit3")->first()->confirmation_token]);
        $response = $this->get($url);
        $response->assertStatus(302);
    }
}
