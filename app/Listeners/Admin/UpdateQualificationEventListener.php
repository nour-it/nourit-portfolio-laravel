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

    private array $qualifications;

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
        $this->qualification = $event->qualification;
        $this->request       = $event->request;
        $this->user          = request()->user();

        $this->qualification->name        = $this->request["name"] ??  $this->qualification->name;
        $this->qualification->description = $this->request["description"] ??  $this->qualification->description;
        $this->qualification->create_at   = $this->request["create_at"] ??  $this->qualification->create_at;
        $this->qualification->desable_at  = $this->request["desable_at"] ?? $this->qualification->desable_at;
        $this->qualification->user_id     = $this->user->id;
        $this->qualification->save();

        $this->qualification->category()->sync($this->request["category_id"]);

        if (isset($this->request["image"])) {

            $this->qualification->images()->createMany([
                ['path' => $this->request["image"]]
            ]);
        }
    }
}
