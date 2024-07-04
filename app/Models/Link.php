<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Link extends Model
{
    use HasFactory;


    public $timestamps = false;

    protected $with = ["social"];

    public $fillable = ['link', 'add_at', 'remove_at', 'user_id', 'social_id'];

    public function category()
    {
        return $this->morphToMany(Category::class, "categorisable");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function social(): BelongsTo
    {
        return $this->belongsTo(Social::class);
    }
}
