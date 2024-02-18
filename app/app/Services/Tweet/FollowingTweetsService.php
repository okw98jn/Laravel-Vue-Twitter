<?php

namespace App\Services\Tweet;

use App\Const\CommonConst;
use App\Models\Tweet;
use App\Models\User;

class FollowingTweetsService extends TweetService
{
    /**
     * フォローしているユーザーのツイート一覧を取得
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFollowingTweets(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $user = User::find(auth()->id());

        if (! $user) {
            return new \Illuminate\Pagination\LengthAwarePaginator([], 0, CommonConst::PAGE_MAX_COUNT);
        }

        $followingTweets = Tweet::whereIn('user_id', $user->follows()->pluck('id'))
            ->withUserAndImages()
            ->withStatusCounts($this->getUserIdFilterClosure())
            ->orderBy('created_at', 'desc')
            ->paginate(CommonConst::PAGE_MAX_COUNT);

        $followingTweets->getCollection()->transform(function ($tweet) {
            return $this->setTweetStatusBooleans($tweet);
        });

        return $followingTweets;
    }
}
