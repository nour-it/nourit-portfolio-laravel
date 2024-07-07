<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    public function test_render_user_profile_page()
    {
        $user = User::first();
        $response = $this->get(route('user.home', ['user' => $user->username]));
        $response->assertStatus(200);
    }

    public function test_render_user_projects_page()
    {
        $user = User::first();
        $response = $this->get(route('user.project.page.index', ['user' => $user->username]));
        $response->assertStatus(200);
    }

    public function test_render_user_services_page()
    {
        $user = User::first();
        $response = $this->get(route('user.service.page.index', ['user' => $user->username]));
        $response->assertStatus(200);
    }

    public function test_render_user_profile_dashboard()
    {
        $response = $this->get(route('profile.index'));
        $response->assertStatus(302);
    }

    public function test_render_user_profile_dashboard_with_logged_user()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route('profile.index'));
        $response->assertStatus(200);
    }

    public function test_update_username()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->put(route("profile.update", ['profile' => $user->id]), [
            'username' => $user->username . ' (edited)'
        ]);
        $response->assertStatus(302);
    }

    public function test_update_with_existing_username()
    {
        $user = User::first();
        Auth::login($user);
        $username = $user->username;
        $response = $this->put(route("profile.update", ['profile' => $user->id]), [
            'username' => User::find(2)->username
        ]);
        $user = User::first();
        $response->assertStatus(302);
        $this->assertEquals($username, $user->username);
    }

    public function test_render_user_admin_page()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route('_users.index'));
        $response->assertStatus(200);
    }
}
