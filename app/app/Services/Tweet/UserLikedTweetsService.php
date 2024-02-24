<?php

namespace App\Services\Tweet;

use App\Const\CommonConst;
use App\Models\Tweet;
use App\Models\User;

class UserLikedTweetsService extends TweetService
{
    /**
     * ユーザーのいいねしたツイート一覧を取得
     *
     * @param  User  $user
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUserLikedTweets(User $user): \Illuminate\Pagination\LengthAwarePaginator
    {
        $tweets = Tweet::whereHas('likes', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->withAllRelations()
            ->withStatusCounts($this->getUserIdFilterClosure())
            ->orderBy('created_at', 'desc')
            ->paginate(CommonConst::PAGE_MAX_COUNT);

        $tweets->getCollection()->transform(function ($tweet) {
            return $this->setTweetStatusBooleans($tweet);
        });

        return $tweets;
    }
}
