<?php

namespace App\Services\Tweet;

use App\Const\CommonConst;
use App\Models\Tweet;

class BookmarkTweetsService extends TweetService
{
    /**
     * ブックマークしたツイート一覧を取得
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getBookmarkTweets(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $tweets = Tweet::whereHas('bookmarks', function ($query) {
            $query->where('user_id', auth()->id());
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
