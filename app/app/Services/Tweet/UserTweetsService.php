<?php

namespace App\Services\Tweet;

use App\Const\CommonConst;
use App\Models\Tweet;
use App\Models\User;

class UserTweetsService extends TweetService
{
    /**
     * ユーザーのツイート一覧を取得
     *
     * @param  User  $user
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUserTweets(User $user): \Illuminate\Pagination\LengthAwarePaginator
    {
        $userIdFilterClosure = $this->getUserIdFilterClosure();

        $tweets = Tweet::where('user_id', $user->id)
            ->withUserAndImages()
            ->withStatusCounts($userIdFilterClosure)
            ->orderBy('created_at', 'desc')
            ->paginate(CommonConst::PAGE_MAX_COUNT);

        $tweets->getCollection()->transform(function ($tweet) {
            return $this->setTweetStatusBooleans($tweet);
        });

        return $tweets;
    }
}
