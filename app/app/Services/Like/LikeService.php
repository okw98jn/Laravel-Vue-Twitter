<?php

namespace App\Services\Like;

use App\Models\Like;
use App\Models\Tweet;

class LikeService
{
    public function like(Tweet $tweet)
    {
        $data = [
            'user_id'  => auth()->id(),
            'tweet_id' => $tweet->id,
        ];

        Like::create($data);
    }
}
