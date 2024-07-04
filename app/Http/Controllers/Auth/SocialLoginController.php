<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{

    public function attempt(Request $request)
    {
        return Socialite::driver($request->get("type"))->redirect();
    }

    public function callback()
    {
        $prev = url()->previous();
        $socialType = substr($prev, strpos($prev, "=") + 1);
        // check if authentication type implemented
        if (method_exists($this, $socialType)) {
            $user = $this->$socialType();
            Auth::login($user);
            $this->redirect = redirect(route("admin.home"));
            return $this->redirect->with("success", "Connected successfully");
        }else {
            $this->redirect = redirect(route("admin.home"));
            return $this->redirect->with("error", "this kind of authentication not implemented");
        }
    }

    private function google()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::orWhere(["google_id" => $googleUser->id, 'email' => $googleUser->email])->first();
        if (is_null($user)) {
            $user = User::create([
                'google_id' => $googleUser->id,
                'username' => $googleUser->name,
                'email' => $googleUser->email,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'google_id' => $googleUser->id
            ]);
        }
        return $user;
    }
}
