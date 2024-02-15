<?php

namespace App\Services\Retweet;

use App\Models\Retweet;
use App\Models\Tweet;

class UnRetweetService
{
    /**
     * リツイート解除
     *
     * @param  Tweet  $tweet
     * @return void
     */
    public function unRetweet(Tweet $tweet): void
    {
        $where = [
            'user_id'  => auth()->id(),
            'tweet_id' => $tweet->id,
        ];

        Retweet::where($where)->delete();
    }
}
