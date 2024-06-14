<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            return view('auth.loging');
        });
    }

    public function attempt(Request $request)
    {
        // $user = User::orWhere([
        //     'email' => $request->input('email'),
        //     'username' => $request->input('email'),
        // ])
        //     ->where(['confirmation_token' => NULL])
        //     ->first();

        $user = $this->userRepository->findUserByUsernameOrMail($request->input("username"), $request->input("email"));

        if (null == $user) {
            return redirect(route("login"), 302)->with("error", "Invalid user");
        }
        if ($user->isValidate() && Hash::check($request->input('password'), $user->password)) {
            Auth::login($user);
            return redirect(route("admin.home"));
        } else {
            return redirect(route("login"), 302)->with("error", "Invalid user");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout($request->user());
        return redirect(route("home"), 302);
    }

    // Enderson nicolas abla

}
