<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $with = ['skillCategory', "images"];

    public $fillable = ['name', 'description', 'skill_category_id', 'add_at'];

    public function skillCategory(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class);
    }

    public function images(): BelongsToMany {
        return $this->morphToMany(Image::class, "imageable");
    }

    public function user(){
        return $this->morphOne(Skill::class, "skillable");
    }
}
