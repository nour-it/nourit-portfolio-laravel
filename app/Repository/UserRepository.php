<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    private ?string $filter;
    private ?string $order = "asc";

    public function __construct(
        private User $user,
        private ?Category $category = new Category()
    ) {
    }

    public function findAll(?int $limit = 15)
    {
        $sql = $this->user
            ->with([
                "role" => fn($q) => $q->select('title'),
            ])
            ->withCount([
                "skill as skill",
                "project as project",
                "service as service",
                "qualification as qualification",
            ]);

        $this->filter = request()->get("filter");
        $this->order = request()->get("order");

        if ($this->filter) {
            if (!$this->order) {
                $this->order = "asc";
            }
            $sql->orderBy($this->filter, $this->order);
        }

        // dd($sql->dump()->paginate($limit));

        return $sql->paginate($limit);
    }

    public function findUserByUsernameOrMail(?string $username = '', ?string $email = ""): User | null
    {
        return $this->user->orWhere([
            'username' => $username,
            'email' => $email,
        ])->first();
    }

    public function findUserByUsernameOrSlug(?string $username = "", ?string $slug = ""): User | null
    {
        return $this->user->orWhere([
            'username' => $username,
            'slug' => $slug,
        ])
            ->with([
                "project" => fn($q) => $q->with([]),
                "images" => fn($q) => $q->with(['category']),
                "resume" => fn($q) => $q->where("remove_at", "!=", null),
            ])
            ->first();
    }

    public function createUserFromRequest(Request $request): User
    {
        $username = $request->input("username");
        return $this->user->create([
            "username" => $username,
            "slug" => Str::slug($username),
            "email" => $request->input("email"),
            "password" => Hash::make($request->input("password")),
            "confirmation_token" => Crypt::encrypt($request->input("email")),
            "ip" => $request->ip(),

        ]);
    }

    public function getContactLink(User $user)
    {
        $linkIds = $this->getLinks("Contact");
        return $user->link()
            ->whereIn("id", $linkIds)
            ->where("link", "!=", "")
            ->where(["remove_at" => null])
            ->get();
    }

    public function getProfileLink(User $user)
    {
        $linkIds = $this->getLinks("Profile");
        return $user->link()
            ->whereIn("id", $linkIds)
            ->where("link", "!=", "")
            ->where(["remove_at" => null])
            ->get();
    }

    private function getLinks(string $type)
    {
        $category = Category::where(["name" => $type, 'type' => Social::class])
            ->with(["link" => fn($q) => $q->select("categorisable_id")])
            ->first();

        $linkIds = $category->link->pluck("categorisable_id");
        return $linkIds;
    }

    public function report()
    {
        return DB::table(DB::raw('(SELECT SUBSTR(`validate_at`, 1, 4) AS `year` FROM users) as years'))
            ->selectRaw('`year`, count(`year`) as count')
            ->whereNot('year', NULL)
            ->groupBy("year")
            ->orderBy("year")
            ->get();
    }
}
