<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function index(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $this->redirect = redirect("dashboard.home");
            return $this->redirect;
        }
        return $this->render($request, function ($request) {
            return view('auth.register');
        });
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $this->userRepository->findUserByUsernameOrMail($request->input("username"), $request->input("email"));
        if ($user) {
            $this->redirect = redirect(route("register"));
            return $this->redirect->with("error", "a user already exists");
        }
        $user = $this->userRepository->createUserFromRequest($request);
        Mail::to($request->input("email"))->later(now()->addSecond(1), new RegisterMail($user));
        $this->redirect = redirect(route("login"));
        return $this->redirect->with("success", "an email was sent to your account");
    }

    public function confirme(Request $request, string $token)
    {
        $user = User::where(['confirmation_token' => $token])->first();
        $user->confirmation_token = NULL;
        $user->save();
        $this->redirect = redirect(route("login"));
        return $this->redirect->with("success", "acount confirmed");
    }
}
