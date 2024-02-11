<?php

namespace App\Services\Like;

use App\Models\Like;
use App\Models\Tweet;

class UnLikeService
{
    /**
     * いいねデータを削除します
     *
     * @param  Tweet  $tweet
     * @return void
     */
    public function unLike(Tweet $tweet): void
    {
        $where = [
            'user_id'  => auth()->id(),
            'tweet_id' => $tweet->id,
        ];

        Like::where($where)->delete();
    }
}
