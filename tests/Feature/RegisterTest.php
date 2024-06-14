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


    public function test_valide_registration_data() 
    {
        $response = $this->post(route("register.new"), [
            'username' => "user",
            'email'    => "user@gmail.com",
            'password' => "0000",
        ]);
        $response->assertStatus(302);
    }

    public function test_send_mail_to_user()
    {
       
        $response = $this->post(route("register.new"), [
            'username' => "user1",
            'email'    => "user1@gmail.com",
            'password' => "0000",
        ]);
        // Mail::fake();
        // Mail::assertQueued(RegisterMail::class);
        $response->assertStatus(302);
    }

    public function test_cofirme_user()
    {
        $response = $this->post(route("register.new"), [
            'username' => "user2",
            'email'    => "user2@gmail.com",
            'password' => "0000",
        ]);
        $response->assertStatus(302);
        $url = route("register.confirme", ['token' => User::where('username', "user2")->first()->confirmation_token]);
        $response = $this->get($url);
        $response->assertStatus(302);
    }

    public function test_invalide_registration_data() 
    {
        $response = $this->post(route("register.new"), [
            'username' => "user",
            'email'    => "user@gmail.com",
            'password' => "0000",
        ]);
        $response->assertStatus(302);
    }
}
