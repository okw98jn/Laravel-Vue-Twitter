<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'video_path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function retweets(): HasMany
    {
        return $this->hasMany(Retweet::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    public function tweetImages(): HasMany
    {
        return $this->hasMany(TweetImage::class);
    }

    public function isRetweetedByUser(User $user): bool
    {
        return $this->retweets->where('user_id', $user->id)->isNotEmpty();
    }

    public function isBookmarkedByUser(User $user): bool
    {
        return $this->bookmarks->where('user_id', $user->id)->isNotEmpty();
    }

    public function isLikedByUser(User $user): bool
    {
        return $this->likes->where('user_id', $user->id)->isNotEmpty();
    }
}
