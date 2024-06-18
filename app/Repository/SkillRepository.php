<?php

namespace App\Repository;

use App\Models\Skill;
use App\Models\User;

class SkillRepository
{

    public function __construct(private Skill $skill)
    {
    }

    public function getUserSkills(User $user)
    {
        return $user->skill()
            ->where(['skillables.delete_at' => NULL])
            ->with(["category", "images"])
            ->paginate(15);
    }

    public function getAvailableSkills()
    {
        return Skill::where(['delete_at' => NULL])
            ->with("category", "images")
            ->paginate(15);
    }
}
