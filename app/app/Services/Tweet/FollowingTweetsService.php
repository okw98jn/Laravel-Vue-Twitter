<?php

namespace App\Services\Tweet;

use App\Const\CommonConst;
use App\Models\Tweet;
use App\Models\User;

class FollowingTweetsService
{
    /**
     * フォローしているユーザーのツイート一覧を取得
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFollowingTweets(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $user = User::find(auth()->id());

        if (!$user) {
            return new \Illuminate\Pagination\LengthAwarePaginator([], 0, CommonConst::PAGE_MAX_COUNT);
        }

        $followingTweets = Tweet::with('user', 'likes')
            ->whereIn('user_id', $user->follows()->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->paginate(CommonConst::PAGE_MAX_COUNT);

        return $followingTweets;
    }
}
