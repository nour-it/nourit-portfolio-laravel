<?php

namespace App\Listeners\Admin;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;

class UpdateProjectEventListener
{
    private Project $project;

    private User $user;

    
    public function handle(object $event): void
    {
        $this->project = $event->project;
        $request = $event->request;
        $this->project->name = $request->input("name");
        $this->project->description = $request->input("description");
        $this->project->add_at = $request->input("add_at", Carbon::now());
        $this->project->delete_at = $request->input("delete_at");
        $this->user = $request->user();
        $this->project->user_id = $this->user->id;
        $this->project->save();

        $this->project->category()->sync($request->input("category_id"));

        $skill = $request->input("skill_id");

        if (NULL !== $skill) {
            $skills = $this->project->skill()->get()->pluck("skillable_id")->toArray();
            if (empty(array_filter($skills, function ($s) use ($skill) {
                return $s == $skill;
            }))) {
                $this->project->skill()->attach($skill, ["add_at" => Carbon::now()]);
            }
        }
    }
}
