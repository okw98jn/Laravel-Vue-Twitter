<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Services\Retweet\RetweetService;
use App\Services\Retweet\UnRetweetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RetweetController extends Controller
{
    /**
     * リツイートAPI
     *
     * @param  Tweet  $tweet
     * @param  RetweetService  $retweetService
     * @return JsonResponse
     */
    public function retweet(Tweet $tweet, RetweetService $retweetService): JsonResponse
    {
        $retweetService->retweet($tweet);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * リツイート解除API
     *
     * @param  Tweet  $tweet
     * @param  UnRetweetService  $unRetweetService
     * @return JsonResponse
     */
    public function unRetweet(Tweet $tweet, UnRetweetService $unRetweetService): JsonResponse
    {
        $unRetweetService->unRetweet($tweet);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
