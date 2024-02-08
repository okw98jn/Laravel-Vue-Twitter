<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Services\Like\LikeService;
use App\Services\Like\UnLikeService;
use Illuminate\Http\Response;

class LikeController extends Controller
{
    public function like(Tweet $tweet, LikeService $likeService)
    {
        $likeService->like($tweet);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function unlike(Tweet $tweet, UnLikeService $UnlikeService)
    {
        $UnlikeService->unLike($tweet);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
