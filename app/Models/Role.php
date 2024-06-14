<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $with = ['user'];

    public $fillable = ['title'];

    public function user() 
    {
        return $this->belongsToMany(User::class);
    }
}
