<?php

namespace App\Services\Tweet;

use App\Const\CommonConst;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FollowingTweetsService extends TweetService
{
    /**
     * フォローしているユーザーのリツーイトを含むツイート一覧を取得
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFollowingTweets(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $user = User::find(auth()->id());

        if (! $user) {
            return new \Illuminate\Pagination\LengthAwarePaginator([], 0, CommonConst::PAGE_MAX_COUNT);
        }

        $followIds = $user->follows()->pluck('id');

        $tweetsQuery = $this->createTweetQuery($followIds);
        $reTweetsQuery = $this->createRetweetQuery($followIds);

        $tweets = $tweetsQuery->unionAll($reTweetsQuery)
            ->orderBy('sort_date', 'desc')
            ->paginate(CommonConst::PAGE_MAX_COUNT);

        $tweets->getCollection()->transform(function ($tweet) {
            return $this->setTweetStatusBooleans($tweet);
        });

        return $tweets;
    }

    /**
     * ユーザーのツイート一覧を取得するためのクエリを作成
     *
     * @param  object  $followIds
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function createTweetQuery(object $followIds): \Illuminate\Database\Eloquent\Builder
    {
        return Tweet::whereIn('user_id', $followIds)
            ->select('tweets.*', DB::raw('NULL as retweeted_user'), 'tweets.created_at as sort_date')
            ->withAllRelations()
            ->withStatusCounts($this->getUserIdFilterClosure());
    }

    /**
     * ユーザーのリツイート一覧を取得するためのクエリを作成
     *
     * @param  object  $followIds
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function createRetweetQuery(object $followIds): \Illuminate\Database\Eloquent\Builder
    {
        return Tweet::whereIn('retweets.user_id', $followIds)
            ->join('retweets', 'tweets.id', '=', 'retweets.tweet_id')
            ->join('users', 'retweets.user_id', '=', 'users.id')
            ->select('tweets.*', 'users.name as retweeted_user', 'retweets.created_at as sort_date')
            ->withAllRelations()
            ->withStatusCounts($this->getUserIdFilterClosure());
    }
}
