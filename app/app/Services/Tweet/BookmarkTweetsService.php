<?php

namespace App\Services\Tweet;

use App\Const\CommonConst;
use App\Models\Tweet;

class BookmarkTweetsService
{
    /**
     * ブックマークしたツイート一覧を取得
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getBookmarkTweets(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $user = auth()->user();

        if (! $user) {
            return new \Illuminate\Pagination\LengthAwarePaginator([], 0, CommonConst::PAGE_MAX_COUNT);
        }

        $tweets = Tweet::whereHas('bookmarks', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->with('user', 'bookmarks', 'likes', 'tweetImages')
            ->orderBy('created_at', 'desc')
            ->paginate(CommonConst::PAGE_MAX_COUNT);

        return $tweets;
    }
}
