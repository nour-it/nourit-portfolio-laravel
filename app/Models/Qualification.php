<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Qualification extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $with = ["images", "category", "address"];

    public $fillable = [
        "name",
        "description",
        "create_at",
        "update_at",
        "desable_at",
        "active_at",
        "user_id",
    ];


    public function images(): BelongsToMany
    {
        return $this->morphToMany(Image::class, "imageable");
    }

    public function category()
    {
        return $this->morphToMany(Category::class, "categorisable");
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
