<?php

namespace App\Listeners\Admin;

use App\Models\Social;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateSocialEventListener
{
    private Social $social;

    private array $request;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
        $this->social  = $event->social;
        $this->request = $event->request;

        $this->social->name        = $this->request["name"];
        // $this->social->description = $this->request["description"];

        $this->social->save();

        $this->updateIcon();
        
    }

    private function updateIcon(): void
    {
        if (isset($this->request["icon"])) {
            $this->social->images()->delete();
            $this->social->images()->create(['path' => $this->request['icon']]);
        }
    }
}
