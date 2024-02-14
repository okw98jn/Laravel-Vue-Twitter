<?php

namespace App\Services\Bookmark;

use App\Models\Bookmark;
use App\Models\Tweet;

class BookmarkService
{
    /**
     * ブックマーク登録
     *
     * @param  Tweet  $tweet
     * @return void
     */
    public function bookmark(Tweet $tweet): void
    {
        $data = [
            'user_id'  => auth()->id(),
            'tweet_id' => $tweet->id,
        ];

        Bookmark::create($data);
    }
}
