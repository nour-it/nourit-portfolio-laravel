<?php

namespace App\Listeners\Admin;

use App\Jobs\ResizeImageJob;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UpdateProjectEventListener
{
    private Project $project;

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
        $this->project = $event->project;
        $request = $event->request;
        $this->project->name = $request->input("name");
        $this->project->description = $request->input("description");
        $this->project->project_category_id = $request->input("project_category_id");
        $this->project->add_at = $request->input("add_at", Carbon::now());
        $this->project->delete_at = $request->input("delete_at");
        $this->user = $request->user();
        
        $this->project->user_id = $this->user->id;
        $this->project->save();
        
        $skill = $request->input("skill_id");

        if (NULL !== $skill) {
            $skills = $this->project->skill()->get()->pluck("skillable_id")->toArray();
            $this->project->skill()->sync([...$skills, $skill]);
            $skill = Skill::find($skill);
            $icon = $request->file("icon");
            if ($icon) {
                $folder = "assets/upload/" . $this->user->id . "/skills/" . Str::lower($skill->name);
                $name = Str::lower($skill->name) . "." . $icon->getClientOriginalExtension();
                $path = $icon->storeAs(
                    $folder,
                    $name,
                    "local"
                );
                ResizeImageJob::dispatch($name, $folder . "/");
                $images = $skill->images()->createMany([
                    ['path' => $path]
                ]);
            }
        }
    }
}
