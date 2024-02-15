<?php

namespace App\Services\Retweet;

use App\Models\Retweet;
use App\Models\Tweet;

class RetweetService
{
    /**
     * リツイート登録
     *
     * @param  Tweet  $tweet
     * @return void
     */
    public function retweet(Tweet $tweet): void
    {
        $data = [
            'user_id'  => auth()->id(),
            'tweet_id' => $tweet->id,
        ];

        Retweet::create($data);
    }
}
