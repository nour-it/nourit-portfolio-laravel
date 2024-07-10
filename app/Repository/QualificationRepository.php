<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Qualification;
use App\Models\User;

class QualificationRepository
{

    public function __construct(
        private Qualification $qualification,
        private ?Category $category = new Category()
        )
    {
    }

    public function getUserQualifications(User $user, ?int $limit = 15)
    {
        return $user->qualification()
            ->paginate($limit);
    }

    public function getAvailableQualifications()
    {
        return Qualification::with("category", "images")
            ->paginate(15);
    }

    public function getCategories()
    {
        return $this->category->where('type', Qualification::class)
            ->withCount(["qualification as qualification"])
            ->get();
    }

    public function findCategory(int $categoryId)
    {
        return $this->category->find($categoryId);
    }
}
