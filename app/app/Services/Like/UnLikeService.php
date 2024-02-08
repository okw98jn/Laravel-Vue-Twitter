<?php

namespace App\Services\Like;

use App\Models\Like;
use App\Models\Tweet;

class UnLikeService
{
    public function unLike(Tweet $tweet)
    {
        $where = [
            'user_id'  => auth()->id(),
            'tweet_id' => $tweet->id,
        ];

        Like::where($where)->delete();
    }
}
