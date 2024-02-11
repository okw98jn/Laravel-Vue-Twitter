<?php

namespace App\Services\Tweet;

use App\Models\Tweet;
use App\Models\User;

class UserTweetsService
{
    /**
     * ユーザーのツイート一覧を取得
     * @param User $user
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUserTweets(User $user): \Illuminate\Pagination\LengthAwarePaginator
    {
        $tweets = Tweet::where('user_id', $user->id)
            ->with('user', 'likes')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return $tweets;
    }
}
