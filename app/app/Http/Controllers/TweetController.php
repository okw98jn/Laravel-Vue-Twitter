<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tweet\TweetListResource;
use App\Models\Tweet;
use App\Models\User;
use App\Services\Tweet\UserTweetsService;
use Illuminate\Http\Response;

class TweetController extends Controller
{
    public function userTweets(User $user, UserTweetsService $userTweetService)
    {
        $userTweets = $userTweetService->getUserTweets($user);

        return new TweetListResource($userTweets);
    }

    public function delete(Tweet $tweet)
    {
        $tweet->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
