<?php

namespace App\Services\User;

use App\Models\Tweet;
use App\Models\User;

class UserTweetListService
{
    public function getUserTweetList(User $user)
    {
        $tweets = Tweet::where('user_id', $user->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return $tweets;
    }
}
