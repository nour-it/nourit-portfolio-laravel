<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    public $with = [];

    public $fillable = [
        'username',
        'email',
        'password',
        'confirmation_token',
        'google_token',
        'google_refresh_token',
        'google_id',
        'token'
    ];

    // relations

    public function skill(): MorphToMany
    {
        return $this->morphToMany(Skill::class, "skillable");
    }

    public function project(): HasMany
    {
        return $this->hasMany(Project::class);
    }


    public function service(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function qualification(): HasMany
    {
        return $this->hasMany(Qualification::class);
    }

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    // queries

    public function isValidate(): bool
    {
        return null == $this->confirmation_token && NULL !== $this->validate_at;
    }
}
