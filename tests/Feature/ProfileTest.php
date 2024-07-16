<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    public function test_render_user_dashboar_page()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route("dashboard.home"));
        $response->assertStatus(200);
    }

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
            'username' => $user->username . ' (edited)',
            'profile' => UploadedFile::fake()->image("demo.png"),
            // 'about_img' => UploadedFile::fake()->image("demo.png"),
        ]);
        $response->assertStatus(302);
        $filename = storage_path("app/upload/{$user->id}/images/profile/demo.png");
        $this->assertFileExists($filename);
        // unlink($filename);
        $filename = storage_path("app/upload/{$user->id}/images/about/demo.png");
        $this->assertFileExists($filename);
        // unlink($filename);
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

    public function test_render_user_dashboard_page()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->get(route('_users.index'));
        $response->assertStatus(200);
    }
}
