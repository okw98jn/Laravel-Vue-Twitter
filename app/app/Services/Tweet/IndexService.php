<?php

namespace App\Services\Tweet;

use App\Const\CommonConst;
use App\Models\Tweet;

class IndexService
{
    /**
     * ツイート一覧を取得
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getTweets(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $tweets = Tweet::with('user', 'likes', 'tweetImages')
            ->orderBy('created_at', 'desc')
            ->paginate(CommonConst::PAGE_MAX_COUNT);

        return $tweets;
    }
}
