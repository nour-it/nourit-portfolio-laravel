<?php

namespace App\Repository;

use App\Models\Service;
use App\Models\Skill;
use App\Models\User;

class ServiceRepository
{

    public function __construct(private Service $service)
    {
    }

    public function getUserServices(User $user)
    {
        return $user->service()
            ->where(['services.desable_at' => NULL])
            ->with(["category", "images"])
            ->paginate(15);
    }

    public function findPublicServices()
    {
        return $this->service->where(["desable_at" => NULL])->paginate(15);
    }
}
