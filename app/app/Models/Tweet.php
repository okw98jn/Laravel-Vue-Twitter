<?php

namespace App\Models;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property bool $is_liked
 * @property bool $is_bookmarked
 * @property bool $is_retweeted
 */
class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'video_path',
    ];

    public function scopeWithUserAndImages(Builder $query): Builder
    {
        return $query->with(['user', 'tweetImages']);
    }

    public function scopeWithStatusCounts(Builder $query, Closure $userIdFilterClosure): Builder
    {
        return $query->withCount([
            'likes as is_liked' => $userIdFilterClosure,
            'bookmarks as is_bookmarked' => $userIdFilterClosure,
            'retweets as is_retweeted' => $userIdFilterClosure,
        ]);
    }

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
}
