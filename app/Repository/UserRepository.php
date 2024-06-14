<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserRepository
{


    public function __construct(private User $user)
    {
    }

    public function findUserByUsernameOrMail(?string $username, ?string  $email): User | null
    {
        return $this->user->orWhere([
            'username' => $username,
            'email'    => $email
        ])->first();
    }

    public function createUserFromRequest(Request $request) : User
    {
        return User::create([
            "username" => $request->input("username"),
            "email" => $request->input("email"),
            "password" => Hash::make($request->input("password")),
            "confirmation_token" =>  Crypt::encrypt($request->input("email")),
            "ip" => $request->ip(),

        ]);
    }

   
}
