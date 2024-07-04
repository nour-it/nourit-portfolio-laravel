<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Social extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $with = ["images"];

    public $fillable = ['name', 'add_at', 'remove_at'];

    public function images(): BelongsToMany
    {
        return $this->morphToMany(Image::class, "imageable");
    }

    public function category()
    {
        return $this->morphToMany(Category::class, "categorisable");
    }
}
