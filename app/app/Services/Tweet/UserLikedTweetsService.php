<?php

namespace App\Services\Tweet;

use App\Models\Tweet;
use App\Models\User;

class UserLikedTweetsService
{
    /**
     * ユーザーのいいねしたツイート一覧を取得
     * @param User $user
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUserLikedTweets(User $user): \Illuminate\Pagination\LengthAwarePaginator
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
