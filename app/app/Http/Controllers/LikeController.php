<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Services\Like\LikeService;
use App\Services\Like\UnLikeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LikeController extends Controller
{
    /**
     * いいねAPI
     * @param Tweet $tweet
     * @param LikeService $likeService
     * @return JsonResponse
     */
    public function like(Tweet $tweet, LikeService $likeService): JsonResponse
    {
        $likeService->like($tweet);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * いいね解除API
     * @param Tweet $tweet
     * @param UnLikeService $UnlikeService
     * @return JsonResponse
     */
    public function unlike(Tweet $tweet, UnLikeService $UnlikeService): JsonResponse
    {
        $UnlikeService->unLike($tweet);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
