<?php

namespace App\Repository;

use App\Models\Project;
use App\Models\User;

class ProjectRepository
{

    public function __construct(
        private Project $project
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
}
