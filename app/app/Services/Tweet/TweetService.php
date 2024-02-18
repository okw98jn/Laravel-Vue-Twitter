<?php

namespace App\Services\Tweet;

use App\Models\Tweet;
use Closure;

class TweetService
{
    /**
     * ログインユーザーのIDを使用して、ツイートに対するアクションをフィルタリングするクロージャを取得
     *
     * @return Closure
     */
    protected function getUserIdFilterClosure(): Closure
    {
        return function ($query) {
            $query->where('user_id', auth()->id());
        };
    }

    /**
     * ログインユーザーがツイートに対して行ったアクションのステータスを設定
     * is_liked、is_bookmarked、is_retweetedの各プロパティを設定します
     *
     * @param  Tweet  $tweet
     * @return Tweet  $tweet
     */
    protected function setTweetStatusBooleans(Tweet $tweet): Tweet
    {
        $tweet->is_liked = $tweet->is_liked > 0;
        $tweet->is_bookmarked = $tweet->is_bookmarked > 0;
        $tweet->is_retweeted = $tweet->is_retweeted > 0;

        return $tweet;
    }
}
