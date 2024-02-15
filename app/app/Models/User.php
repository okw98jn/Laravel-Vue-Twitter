<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'introduction',
        'location',
        'birthday',
        'icon_image',
        'header_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    protected function birthDay(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('Y年m月d日'),
            set: fn ($value) => Carbon::createFromFormat('Y年m月d日', $value) ? Carbon::createFromFormat('Y年m月d日', $value)->format('Y-m-d') : '',
        );
    }

    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class);
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

    public function follows(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    /**
     * ログインユーザーがフォローしているかどうか
     *
     * @param  int  $userId
     * @return bool
     */
    public function isFollowing(int $userId): bool
    {
        $authUser = $this->find(auth()->id());

        return $authUser ? $authUser->follows()->where('followed_id', $userId)->exists() : false;
    }

    /**
     * ログインユーザーがフォローされているかどうか
     *
     * @param  int  $userId
     * @return bool
     */
    public function isFollowedBy(int $userId): bool
    {
        $authUser = $this->find(auth()->id());

        return $authUser ? $authUser->followers()->where('follower_id', $userId)->exists() : false;
    }
}
