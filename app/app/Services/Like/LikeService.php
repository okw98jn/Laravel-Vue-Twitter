<?php

namespace App\Services\Like;

use App\Models\Like;
use App\Models\Tweet;

class LikeService
{
    /**
     * いいねデータを作成します
     *
     * @param  Tweet  $tweet
     * @return void
     */
    public function like(Tweet $tweet): void
    {
        $data = [
            'user_id'  => auth()->id(),
            'tweet_id' => $tweet->id,
        ];

        Like::create($data);
    }
}
