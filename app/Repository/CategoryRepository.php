<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Social;

class CategoryRepository
{

    public function __construct(private Category $category)
    {
    }

    public function socialType()
    {
        return $this->category->where(['type' => Social::class])->get();
    }
}
