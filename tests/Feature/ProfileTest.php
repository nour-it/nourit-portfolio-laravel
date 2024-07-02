<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    public function test_update_username()
    {
        $user = User::first();
        Auth::login($user);
        $response = $this->put(route("profile.update", ['profile' => $user->id]), [
            'username' => $user->username . ' (edited)'
        ]);
        $response->assertStatus(302);
    }
}
