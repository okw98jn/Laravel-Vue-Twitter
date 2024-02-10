<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tweet\TweetListResource;
use App\Models\Tweet;
use App\Models\User;
use App\Services\Tweet\UserLikedTweetsService;
use App\Services\Tweet\UserTweetsService;
use Illuminate\Http\Response;

class TweetController extends Controller
{
    public function userTweets(User $user, UserTweetsService $userTweetService)
    {
        $userTweets = $userTweetService->getUserTweets($user);

        if ($userTweets->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return new TweetListResource($userTweets);
    }

    public function userLikedTweets(User $user, UserLikedTweetsService $userLikedTweetsService)
    {
        $likedTweets = $userLikedTweetsService->getUserLikedTweets($user);

        if ($likedTweets->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return new TweetListResource($likedTweets);
    }

    public function delete(Tweet $tweet)
    {
        $this->authorize('delete', $tweet);

        $tweet->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
