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
        'user_id',
        'text',
        'quoted_tweet_id',
        'reply_tweet_id',
    ];

    public function scopeWithAllRelations(Builder $query): Builder
    {
        return $query->with([
            'user',
            'tweetImages',
            'tweetVideos',
            'likes',
            'retweets',
            'bookmarks',
            'quotes',
            'quotedTweet',
            'replies',
        ]);
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

    public function quotedTweet(): BelongsTo
    {
        return $this->belongsTo(Tweet::class, 'quoted_tweet_id');
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Tweet::class, 'quoted_tweet_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Tweet::class, 'reply_tweet_id');
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

    public function tweetVideos(): HasMany
    {
        return $this->hasMany(TweetVideo::class);
    }
}
