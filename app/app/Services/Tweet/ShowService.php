<?php

namespace App\Services\Tweet;

use App\Models\Tweet;

class ShowService extends TweetService
{
    public function getTweet(int $tweetId): Tweet
    {
        $tweet = Tweet::findOrFail($tweetId);

        return $tweet;
    }
}
