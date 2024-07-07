<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resume extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $with = ["user"];

    public $fillable = ['path', 'add_at', 'remove_at', 'user_id', 'social_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
