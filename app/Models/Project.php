<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $with = ["images"];


    public function images(): BelongsToMany
    {
        return $this->morphToMany(Image::class, "imageable");
    }

    public function skill()
    {
        return $this->morphToMany(Skill::class, "skillable");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->morphToMany(Category::class, "categorisable");
    }
}
