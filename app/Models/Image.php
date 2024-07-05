<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    public $fillable = ['path'];

    public function category()
    {
        return $this->morphToMany(Category::class, "categorisable");
    }

}
