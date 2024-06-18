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

    private Request $request;

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
        $this->user     = $this->request->user();

        $this->service->title       = $this->request->input("title");
        $this->service->description = $this->request->input("description");
        $this->service->create_at   = $this->request->input("create_at", Carbon::now());
        $this->service->desable_at  = $this->request->input("desable_at");
        $this->service->user_id     = $this->user->id;
        $this->service->save();

        $this->service->category()->sync($this->request->input("category_id"));
        
        $image = $this->request->file("image");
        if ($image) {
            $folder = "upload/" . $this->user->id . "/services/" . Str::lower($this->service->title) ;
            $name   = Str::lower($this->service->title) . "." . $image->getClientOriginalExtension();
            $path   = $image->storeAs(
                $folder,
                $name,
                "local"
            );
            ResizeImageJob::dispatch($name, $folder . "/");
            $this->service->images()->createMany([
                ['path' => $path]
            ]);
        }
    }
}
