<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TweetVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tweet_id',
        'path',
    ];

    public function tweet(): BelongsTo
    {
        return $this->belongsTo(Tweet::class);
    }
}
