<?php

namespace App\Services\Tweet;

use App\Models\Tweet;
use App\Models\User;

class UserTweetsService
{
    public function getUserTweets(User $user)
    {
        $tweets = Tweet::where('user_id', $user->id)
            ->with('user', 'likes')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return $tweets;
    }
}
