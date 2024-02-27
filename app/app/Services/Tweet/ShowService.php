<?php

namespace App\Services\Tweet;

use App\Models\Tweet;

class ShowService extends TweetService
{
    /**
     * ツイート詳細をリプも含めて取得
     *
     * @param  Tweet  $tweet
     * @return \Illuminate\Support\Collection
     */
    public function getTweetAndReplies(Tweet $tweet): \Illuminate\Support\Collection
    {
        $tweet = $this->getTweet($tweet->id);
        $replyTweets = $this->getReplies($tweet->id);

        return collect(['tweet' => $tweet, 'replyTweets' => $replyTweets]);
    }

    /**
     * ツイートを取得
     *
     * @param  int  $tweetId
     * @return Tweet
     */
    private function getTweet(int $tweetId): Tweet
    {
        $tweet = Tweet::where('id', $tweetId)
            ->withAllRelations()
            ->withStatusCounts($this->getUserIdFilterClosure())
            ->first();

        return $this->setTweetStatusBooleans($tweet);
    }

    /**
     * リプライツイートを取得
     *
     * @param  int  $tweetId
     * @return \Illuminate\Support\Collection
     */
    private function getReplies(int $tweetId): \Illuminate\Support\Collection
    {
        $replyTweets = Tweet::where('reply_tweet_id', $tweetId)
            ->withAllRelations()
            ->withStatusCounts($this->getUserIdFilterClosure())
            ->orderBy('created_at', 'desc')
            ->get();

        return $replyTweets->transform(function ($tweet) {
            return $this->setTweetStatusBooleans($tweet);
        });
    }
}
