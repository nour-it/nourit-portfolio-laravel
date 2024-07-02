<?php

namespace App\Listeners\Admin;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Hash;

class UpdateProfileEventListener
{

    private Request $request;

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

        $this->user->email    = $this->request->input('email', $this->user->email);
        $this->user->username = $this->request->input('username', $this->user->username);
        $this->user->bio      = $this->request->input('bio', $this->user->bio);
        $this->user->about    = $this->request->input('about', $this->user->about);

        if ($this->request->input("password")) {
            $this->user->password = Hash::make($this->request->input('username'));
        }

        $this->user->save();
    }
}
