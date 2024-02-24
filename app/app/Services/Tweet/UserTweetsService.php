<?php

namespace App\Services\Tweet;

use App\Const\CommonConst;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserTweetsService extends TweetService
{
    /**
     * ユーザーのリツーイトを含むツイート一覧を取得
     *
     * @param  User  $user
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUserTweets(User $user): \Illuminate\Pagination\LengthAwarePaginator
    {
        $tweetsQuery = $this->createTweetQuery($user->id);
        $reTweetsQuery = $this->createRetweetQuery($user->id);

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
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function createTweetQuery(int $userId): \Illuminate\Database\Eloquent\Builder
    {
        return Tweet::where('user_id', $userId)
            ->select('tweets.*', DB::raw('NULL as retweeted_user'), 'tweets.created_at as sort_date')
            ->withAllRelations()
            ->withStatusCounts($this->getUserIdFilterClosure());
    }

    /**
     * ユーザーのリツイート一覧を取得するためのクエリを作成
     *
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function createRetweetQuery(int $userId): \Illuminate\Database\Eloquent\Builder
    {
        return Tweet::where('retweets.user_id', $userId)
            ->join('retweets', 'tweets.id', '=', 'retweets.tweet_id')
            ->join('users', 'retweets.user_id', '=', 'users.id')
            ->select('tweets.*', 'users.name as retweeted_user', 'retweets.created_at as sort_date')
            ->withAllRelations()
            ->withStatusCounts($this->getUserIdFilterClosure());
    }
}
