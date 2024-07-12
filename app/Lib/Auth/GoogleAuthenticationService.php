<?php

namespace App\Lib\Auth;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthenticationService implements SocialAuthServiceInterface
{

    public function getPage(): RedirectResponse
    {
        return Socialite::driver("google")->redirect();
    }

    public function getUser(): User|null
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::orWhere(["google_id" => $googleUser->id, 'email' => $googleUser->email])->first();
        $username = $googleUser->name;
        if (is_null($user)) {
            $user = User::create([
                'google_id' => $googleUser->id,
                'username' => $username,
                'slug' => Str::slug($username),
                'email' => $googleUser->email,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'google_id' => $googleUser->id
            ]);
        }
        return $user;
    }
}
