<?php

namespace App\Services\Bookmark;

use App\Models\Bookmark;
use App\Models\Tweet;

class UnBookmarkService
{
    /**
     * ブックマーク解除
     *
     * @param  Tweet  $tweet
     * @return void
     */
    public function unBookmark(Tweet $tweet): void
    {
        $where = [
            'user_id'  => auth()->id(),
            'tweet_id' => $tweet->id,
        ];

        Bookmark::where($where)->delete();
    }
}
