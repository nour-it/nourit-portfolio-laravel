<?php

namespace App\Repository;

use App\Models\Qualification;
use App\Models\User;

class QualificationRepository
{

    public function __construct(private Qualification $qualification)
    {
    }

    public function getUserQualifications(User $user)
    {
        return $user->qualification()
            ->paginate(15);
    }

    public function getAvailableQualifications()
    {
        return Qualification::with("category", "images")
            ->paginate(15);
    }
}
