<?php

namespace App\Listeners\Admin;

use App\Jobs\ResizeImageJob;
use App\Models\Qualification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class UpdateQualificationEventListener
{
    private Qualification $qualification;

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
        $this->qualification = $event->qualification;
        $this->request       = $event->request;
        $this->user          = $this->request->user();

        $this->qualification->name       = $this->request->input("name");
        $this->qualification->description = $this->request->input("description");
        $this->qualification->create_at   = $this->request->input("create_at", Carbon::now());
        $this->qualification->desable_at  = $this->request->input("desable_at");
        $this->qualification->user_id     = $this->user->id;
        $this->qualification->save();

        $this->qualification->category()->sync($this->request->input("category_id"));
        
        $image = $this->request->file("image");
        if ($image) {
            $folder = "upload/" . $this->user->id . "/qualifications/" . Str::lower($this->qualification->name) ;
            $name   = Str::lower($this->qualification->name) . "." . $image->getClientOriginalExtension();
            $path   = $image->storeAs(
                $folder,
                $name,
                "local"
            );
            ResizeImageJob::dispatch($name, $folder . "/");
            $this->qualification->images()->createMany([
                ['path' => $path]
            ]);
        }
    }
}
