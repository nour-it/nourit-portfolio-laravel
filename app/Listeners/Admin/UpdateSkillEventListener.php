<?php

namespace App\Listeners\Admin;

use App\Events\Admin\UpdateSkillEvent;
use App\Jobs\ResizeImageJob;
use App\Models\Category;
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

    public function handle(UpdateSkillEvent $event): void
    {
        $skill = $event->skill;
        $request = $event->request;
        $skill->name = $request->input("name");
        $skill->description = $request->input("description");
        $skill->create_at = $request->input("create_at", Carbon::now());
        $skill->delete_at = $request->input("delete_at");
        $skill->save();

        $skill->category()->sync($request->input("category_id"));
    
        $this->user = $request->user();
        $skills = $this->user->skill()->get()->pluck("id")->toArray();
        $this->user->skill()->sync([...$skills, $skill->id]);
        
        $icon = $request->file("icon");
        if ($icon) {
            $folder = "upload/" . $this->user->id . "/skills/" . Str::lower($skill->name) ;
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
