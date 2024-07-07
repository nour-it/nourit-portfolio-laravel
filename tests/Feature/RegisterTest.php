<?php

namespace Tests\Feature;

use App\Mail\RegisterMail;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Database\Seeders\SkillSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    public function test_render_register_page(): void
    {
        $response = $this->get(route("register"));
        $response->assertStatus(200);
    }

    public function test_render_register_page_with_logged_user(): void
    {
        Auth::login(User::first());
        $response = $this->get(route('register'));
        $response->assertStatus(302);
    }


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
        $id = User::count();
        $response = $this->post(route("register.new"), [
            'username' => "user" . $id,
            'email'    => "user{$id}@gmail.com",
            'password' => "0000",
        ]);
        $response->assertStatus(302);
        $url = route("register.confirme", ['token' => User::where('username', "user{$id}")->first()->confirmation_token]);
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
