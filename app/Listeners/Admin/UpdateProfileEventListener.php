<?php

namespace App\Listeners\Admin;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
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
        $this->user    = $event->user;

        $this->user->email    = $this->request['email']     ?? $this->user->email;
        $this->user->username = $this->request['username']  ?? $this->user->username;
        $this->user->bio      = $this->request['bio']       ?? $this->user->bio;
        $this->user->about    = $this->request['about']     ?? $this->user->about;

        if (isset($this->request["password"])) {
            $this->user->password = Hash::make($this->request['username']);
        }

        $this->user->save();
    }
}
