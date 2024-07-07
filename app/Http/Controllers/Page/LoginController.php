<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Repository\UserRepository;
use DateTime;
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
        $user = $request->user();
        if ($user) {
            $this->redirect = redirect(route("dashboard.home"));
            return $this->redirect;
        }
        return $this->render($request, function ($request) {
            $this->view = view('auth.loging');
            return $this->view->render();
        });
    }

    public function attempt(LoginRequest $request)
    {
        $user = $this->userRepository->findUserByUsernameOrMail($request->input("email"), $request->input("email"));

        if (null == $user) {
            $this->redirect = redirect(route("login"), 302);
            return $this->redirect->with("error", "user not found");
        }

        if ($user->isValidate() && Hash::check($request->input('password'), $user->password)) {
            Auth::login($user);
            $user->lastlogin_at = new DateTime();
            $user->ip = request()->ip();
            $user->save();
            return redirect(route("dashboard.home"));
        } else {

            $this->redirect = redirect(route("login"), 302);
            return $this->redirect->with("error", "Invalid user");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout($request->user());
        $this->redirect = redirect(route("home"), 302);
        return $this->redirect;
    }
}
