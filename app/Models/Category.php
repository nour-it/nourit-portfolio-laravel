<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $with = ["images"];

    public $fillable = ['name', 'icon', 'delete_at', 'description', 'update_at', 'create_at'];

    public function images(): BelongsToMany
    {
        return $this->morphToMany(Image::class, "imageable");
    }

    public function skill()
    {
        return $this->morphedByMany(Skill::class, "categorisable");
    }

    public function project()
    {
        return $this->morphedByMany(Project::class, "categorisable");
    }
}
