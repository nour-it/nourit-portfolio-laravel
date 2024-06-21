<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $with = [];

    public $fillable =  [
        "country",
        "city",
        "long",
        "lat",
        "qualification_id",
    ];

    public function qualification(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    
}
