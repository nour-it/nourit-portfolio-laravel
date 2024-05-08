<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'username', 'email', 'password', 'confirmation_token',
        'google_token',
        'google_refresh_token',
        'google_id',
        'token'
    ];
}
