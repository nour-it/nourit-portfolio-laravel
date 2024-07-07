<?php

namespace App\Listeners\Admin;

use App\Jobs\ResizeImageJob;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Str;

class UpdateServiceEventListener
{
    private Service $service;

    private array $services;

    private array $request;

    private User $user;

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
        $this->service = $event->service;
        $this->request = $event->request;
        $this->user    = request()->user();

        $this->service->title       = $this->request["title"] ?? $this->service->title;
        $this->service->description = $this->request["description"] ?? $this->service->description;
        $this->service->create_at   = $this->request["create_at"] ?? Carbon::now();
        $this->service->desable_at  = $this->request["desable_at"] ?? $this->service->desable_at;
        $this->service->user_id     = $this->user->id;
        $this->service->save();

        $this->service->category()->sync($this->request["category_id"]);

        if (isset($this->request["image"])) {
            $this->service->images()->createMany([
                ['path' =>  $this->request["image"]]
            ]);
        }
    }
}
