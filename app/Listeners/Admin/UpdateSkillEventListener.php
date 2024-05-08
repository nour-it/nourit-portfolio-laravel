<?php

namespace App\Listeners\Admin;

use App\Events\Admin\UpdateSkillEvent;
use App\Jobs\ResizeImageJob;
use App\Models\Image;
use App\Models\Skill;
use DateTime;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class UpdateSkillEventListener 
{

    use InteractsWithQueue;

    public $delay = 1;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(UpdateSkillEvent $event): void
    {
        $skill = $event->skill;
        $request = $event->request;
        $skill->name = $request->input("name");
        $skill->description = $request->input("description");
        $skill->skill_category_id = $request->input("skill_category_id");
        $skill->save();

        $icon = $request->file("icon");
        if ($icon) {
            $path = $icon->storeAs(
                "assets/img/skill",
                Str::lower($skill->name) . "." . $icon->getClientOriginalExtension(),
                "local"
            );
            ResizeImageJob::dispatch($path);
            $images = $skill->images()->createMany([
                ['path' => $path]
            ]);
        }
    }
}
