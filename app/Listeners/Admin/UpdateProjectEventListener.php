<?php

namespace App\Listeners\Admin;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;

class UpdateProjectEventListener
{
    private Project $project;

    private User $user;

    private array $request;


    public function handle(object $event): void
    {
        $this->project = $event->project;
        $this->request = $event->request;
        $this->user    = request()->user();

        $this->project->name        = $this->request["name"] ?? $this->project->name;
        $this->project->description = $this->request["description"] ?? $this->project->description;
        $this->project->add_at      = $this->request["add_at"] ?? $this->project->add_at;
        $this->project->delete_at   = $this->request["delete_at"] ?? $this->project->delete_at;
        $this->project->user_id     = $this->user->id;
        
        $this->project->save();

        $this->project->category()->sync($this->request["category_id"]);

        $skill = $this->request["skill_id"];

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
