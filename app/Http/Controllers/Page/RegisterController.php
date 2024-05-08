<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        return $this->render($request, function ($request) {
            return view('auth.register');
        });
    }

    public function store(Request $request)
    {
        $user = User::create([
            "username" => $request->input("username"),
            "email" => $request->input("email"),
            "password" => Hash::make($request->input("password")),
            "confirmation_token" =>  Crypt::encrypt($request->input("email")),
       
        ]);
        Mail::to($request->input("email"))->later(now()->addSecond(1), new RegisterMail($user));
        return redirect(route("login"))->with("success", "an email was sent to your account");
    }

    public function confirme(Request $request, string $token)
    {
        $user = User::where(['confirmation_token' => $token])->first();
        $user->confirmation_token = NULL;
        $user->save();
        return redirect(route("login"))->with("success", "acount confirmed");
    }
}
