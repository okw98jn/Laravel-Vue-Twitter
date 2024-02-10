<?php

namespace App\Services\Tweet;

use App\Models\Tweet;
use App\Models\User;

class UserLikedTweetsService
{
    public function getUserLikedTweets(User $user)
    {
        $tweets = Tweet::whereHas('likes', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->with('user', 'likes')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return $tweets;
    }
}
