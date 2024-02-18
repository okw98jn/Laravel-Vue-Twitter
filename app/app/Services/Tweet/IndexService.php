<?php

namespace App\Services\Tweet;

use App\Const\CommonConst;
use App\Models\Tweet;

class IndexService extends TweetService
{
    /**
     * ツイート一覧を取得
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getTweets(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $userIdFilterClosure = $this->getUserIdFilterClosure();

        $tweets = Tweet::withUserAndImages()
            ->withStatusCounts($userIdFilterClosure)
            ->orderBy('created_at', 'desc')
            ->paginate(CommonConst::PAGE_MAX_COUNT);

        $tweets->getCollection()->transform(function ($tweet) {
            return $this->setTweetStatusBooleans($tweet);
        });

        return $tweets;
    }
}
