<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Skill;
use App\Models\User;

class SkillRepository
{

    public function __construct(
        private Skill $skill,
        private Category $category
    ) {
    }

    public function getUserSkills(User $user, ?int $limit = 15)
    {
        return $user->skill()
            ->where(['skillables.delete_at' => null])
            ->with(["category", "images"])
            ->paginate($limit);
    }

    public function getAvailableSkills()
    {
        return $this->skill->where(['delete_at' => null])
            ->with("category", "images")
            ->paginate(15);
    }

    public function getCategories()
    {
        return $this->category->where('type', Skill::class)
            ->withCount(["skill as skill"])
            ->paginate();
    }

    public function findCategory(int $categoryId)
    {
        return $this->category

            ->find($categoryId);
    }
}
