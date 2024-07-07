<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;

class ProjectRepository
{

    public function __construct(
        private Project $project,
        private Category $category
    ) {
    }


    public function getUserProject(User $user, ?int $limit = 15)
    {
        return $user->project()
            ->with(["category", "images"])
            ->paginate($limit);
    }

    public function findPublicProject()
    {
        return $this->project
            ->where(["delete_at" => NULL])
            ->paginate(15);
    }

    public function findCategory(int $categoryId)
    {
        return $this->category->find($categoryId);
    }

    public function getCategories()
    {
        return $this->category->where('type', Project::class)
            ->with(["project" => fn ($q) => $q->select('projects.id')])
            ->get();
    }
}
