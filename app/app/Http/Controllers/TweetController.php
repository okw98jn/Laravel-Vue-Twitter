<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tweet\TweetListResource;
use App\Models\Tweet;
use App\Models\User;
use App\Services\Tweet\FollowingTweetsService;
use App\Services\Tweet\IndexService;
use App\Services\Tweet\UserLikedTweetsService;
use App\Services\Tweet\UserTweetsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TweetController extends Controller
{
    /**
     * ツイート一覧API
     *
     * @param  IndexService  $indexService
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(IndexService $indexService): AnonymousResourceCollection|JsonResponse
    {
        $tweets = $indexService->getTweets();

        if ($tweets->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return TweetListResource::collection($tweets);
    }

    /**
     * フォローしているユーザーのツイート一覧API
     *
     * @param  FollowingTweetsService  $followingTweetsService
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function followingTweets(FollowingTweetsService $followingTweetsService): AnonymousResourceCollection|JsonResponse
    {
        $followingTweets = $followingTweetsService->getFollowingTweets();

        if ($followingTweets->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return TweetListResource::collection($followingTweets);
    }

    /**
     * ユーザーのツイート一覧API
     *
     * @param  User  $user
     * @param  UserTweetsService  $userTweetService
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function userTweets(User $user, UserTweetsService $userTweetService): AnonymousResourceCollection|JsonResponse
    {
        $userTweets = $userTweetService->getUserTweets($user);

        if ($userTweets->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return TweetListResource::collection($userTweets);
    }

    /**
     * ユーザーのいいねしたツイート一覧API
     *
     * @param  User  $user
     * @param  UserLikedTweetsService  $userLikedTweetsService
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function userLikedTweets(User $user, UserLikedTweetsService $userLikedTweetsService): AnonymousResourceCollection|JsonResponse
    {
        $likedTweets = $userLikedTweetsService->getUserLikedTweets($user);

        if ($likedTweets->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return TweetListResource::collection($likedTweets);
    }

    /**
     * ツイート削除API
     *
     * @param  Tweet  $tweet
     * @return JsonResponse
     */
    public function delete(Tweet $tweet): JsonResponse
    {
        $this->authorize('delete', $tweet);

        $tweet->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
