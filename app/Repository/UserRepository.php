<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserRepository
{


    public function __construct(private User $user)
    {
    }

    public function findAll(?int $limit = 15)
    {
        return $this->user
            ->with([
                "role"          => fn ($q) => $q->select("title"),
                "skill"         => fn ($q) => $q->with([]),
                "project"       => fn ($q) => $q->with([]),
                "service"       => fn ($q) => $q->with([]),
                "qualification" => fn ($q) => $q->with([]),
            ])
            ->paginate($limit);
    }

    public function findUserByUsernameOrMail(?string $username = '', ?string  $email = ""): User | null
    {
        return $this->user->orWhere([
            'username' => $username,
            'email'    => $email
        ])->first();
    }

    public function createUserFromRequest(Request $request): User
    {
        return User::create([
            "username" => $request->input("username"),
            "email" => $request->input("email"),
            "password" => Hash::make($request->input("password")),
            "confirmation_token" =>  Crypt::encrypt($request->input("email")),
            "ip" => $request->ip(),

        ]);
    }

    public function getContactLink(User $user)
    {
        $linkIds = $this->getLinks("Contact");
        return $user->link()
            ->whereIn("id", $linkIds)
            ->where("link", "!=", "")
            ->where(["remove_at" => NULL])
            ->get();
    }

    public function getProfileLink(User $user)
    {
        $linkIds = $this->getLinks("Profile");
        return $user->link()
            ->whereIn("id", $linkIds)
            ->where("link", "!=", "")
            ->where(["remove_at" => NULL])
            ->get();
    }

    private function getLinks(string $type)
    {
        $category = Category::where(["name" => $type, 'type' => Social::class])
            ->with(["link" => fn ($q) => $q->select("categorisable_id")])
            ->first();

        $linkIds = $category->link->pluck("categorisable_id");
        return $linkIds;
    }
}
