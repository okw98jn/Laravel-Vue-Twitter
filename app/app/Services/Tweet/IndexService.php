<?php

namespace App\Services\Tweet;

use App\Const\CommonConst;
use App\Models\Tweet;
use Illuminate\Support\Facades\DB;

class IndexService extends TweetService
{
    /**
     * リツーイトを含むツイート一覧を取得
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getTweets(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $tweetsQuery = $this->createTweetQuery();
        $reTweetsQuery = $this->createRetweetQuery();

        $tweets = $tweetsQuery->unionAll($reTweetsQuery)
            ->orderBy('sort_date', 'desc')
            ->paginate(CommonConst::PAGE_MAX_COUNT);

        $tweets->getCollection()->transform(function ($tweet) {
            return $this->setTweetStatusBooleans($tweet);
        });

        return $tweets;
    }

    /**
     * ツイート一覧を取得するためのクエリを作成
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function createTweetQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Tweet::select('tweets.*', DB::raw('NULL as retweeted_user'), 'tweets.created_at as sort_date')
            ->withUserAndImages()
            ->withStatusCounts($this->getUserIdFilterClosure());
    }

    /**
     * リツイート一覧を取得するためのクエリを作成
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function createRetweetQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Tweet::join('retweets', 'tweets.id', '=', 'retweets.tweet_id')
            ->join('users', 'retweets.user_id', '=', 'users.id')
            ->select('tweets.*', 'users.name as retweeted_user', 'retweets.created_at as sort_date')
            ->withUserAndImages()
            ->withStatusCounts($this->getUserIdFilterClosure());
    }
}
