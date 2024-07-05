<?php

namespace App\Listeners\Admin;

use App\Models\Link;
use App\Models\User;
use DateTime;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateProfileEventListener
{

    private array $request;

    private User $user;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->request = $event->request;
        $this->user    = $event->user->load("link");

        unset($this->request["_method"], $this->request["_token"]);

        $this->user->email    = $this->request['email']     ?? $this->user->email;
        $this->user->username = $this->request['username']  ?? $this->user->username;
        $this->user->bio      = $this->request['bio']       ?? $this->user->bio;
        $this->user->about    = $this->request['about']     ?? $this->user->about;

        if (isset($this->request["password"])) {
            $this->user->password = Hash::make($this->request['username']);
        }

        $this->updateLink();

        $this->user->save();
    }


    private function updateLink()
    {
        if (!isset($this->request["social_count"])) return;

        $ids = $this->user->link->pluck("id");
        $this->user->link()->delete();

        $links = [];
        for ($i = 1; $i <= $this->request['social_count']; $i++) {
            $links[] = [
                'link'      => $this->request['social_' . $i] ?? "",
                'user_id'   => $this->user->id,
                "social_id" => $i,
                "add_at"    => new DateTime(),
                "remove_at" => isset($this->request['on_' . $i]) && $this->request['on_' . $i] == "on"  ? null : new DateTime() ,
            ];
        }

        Link::insert($links);

        $links = $this->user->link()->get();
        $categories = [];
        foreach ($links as $link) {
            $categories[] = [
                'category_id'        => $this->request['type_id_' . $link->social_id],
                "categorisable_id"   => $link->id,
                "categorisable_type" => Link::class,
                'add_at'             => new DateTime()
            ];
        }

        DB::table('categorisables')
            ->whereIn("categorisable_id", $ids)
            ->where(["categorisable_type" => Link::class])
            ->delete();

        DB::table('categorisables')->insert($categories);
    }
}
