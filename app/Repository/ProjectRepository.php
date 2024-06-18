<?php

namespace App\Repository;

use App\Models\Project;

class ProjectRepository
{

    public function __construct(
        private Project $project
    ) {
    }

    public function findPublicProject()
    {
        return $this->project->where(["delete_at" => NULL])->paginate(15);
    }
}
