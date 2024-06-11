<?php

namespace App\Listeners\Admin;

use App\Events\Admin\UpdateSkillEvent;
use App\Jobs\ResizeImageJob;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UpdateSkillEventListener 
{

    use InteractsWithQueue;

    public $delay = 1;

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
    public function handle(UpdateSkillEvent $event): void
    {
        $skill = $event->skill;
        $request = $event->request;
        $skill->name = $request->input("name");
        $skill->description = $request->input("description");
        $skill->skill_category_id = $request->input("skill_category_id");
        $skill->add_at = $request->input("add_at", Carbon::now());
        $skill->delete_at = $request->input("delete_at");
        $skill->save();

        $this->user = $request->user();

        $skills = $this->user->skill()->get()->pluck("skillable_id")->toArray();
        $this->user->skill()->sync(Arr::map([...$skills, $skill->id], fn($s) => ["skill_id" => $s]));
        


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
