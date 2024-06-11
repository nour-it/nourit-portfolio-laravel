<?php

namespace App\Listeners\Admin;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;

class UpdateProjectEventListener
{
    private Project $project;
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
        $this->project->save();

        $skill = $request->input("skill_id");

        if (NULL !== $skill) {
            $skills = $this->project->skill()->get()->pluck("skillable_id")->toArray();
            $this->project->skill()->sync(Arr::map([...$skills, $skill], fn($s) => ["skill_id" => $s]));
        }

        $icon = $request->file("icon");
        // if ($icon) {
        //     $path = $icon->storeAs(
        //         "assets/img/skill",
        //         Str::lower($skill->name) . "." . $icon->getClientOriginalExtension(),
        //         "local"
        //     );
        //     ResizeImageJob::dispatch($path);
        //     $images = $skill->images()->createMany([
        //         ['path' => $path]
        //     ]);
        // }
    }
}
