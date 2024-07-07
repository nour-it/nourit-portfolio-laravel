<?php

namespace App\Listeners\Admin;

use App\Events\Admin\UpdateSkillEvent;
use App\Jobs\ResizeImageJob;
use App\Models\Category;
use App\Models\Skill;
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

    private array $request;

    private Skill $skill;


    public function handle(UpdateSkillEvent $event): void
    {
        $this->user = request()->user();

        $this->skill              = $event->skill;
        $this->request            = $event->request;
        $this->skill->name        = $this->request["name"] ??  $this->skill->name;
        $this->skill->description = $this->request["description"] ??  $this->skill->description;
        $this->skill->create_at   = $this->request["create_at"] ?? $this->skill->create_at;
        $this->skill->delete_at   = $this->request["delete_at"] ?? $this->skill->delete_at;

        $this->skill->save();

        $this->skill->category()->sync($this->request["category_id"]);

        $skills = $this->user->skill()->get()->pluck("id")->toArray();
        $this->user->skill()->sync([...$skills, $this->skill->id]);

        if (isset($this->request["icon"])) {
            $this->skill->images()->createMany([
                ['path' => $this->request["icon"]]
            ]);
        }
    }
}
