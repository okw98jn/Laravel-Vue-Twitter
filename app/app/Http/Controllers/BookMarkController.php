<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Services\Bookmark\BookmarkService;
use App\Services\Bookmark\UnBookmarkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookMarkController extends Controller
{
    /**
     * ブックマークAPI
     *
     * @param  Tweet  $tweet
     * @param  BookMarkService  $bookMarkService
     * @return JsonResponse
     */
    public function bookMark(Tweet $tweet, BookmarkService $bookMarkService): JsonResponse
    {
        $bookMarkService->bookMark($tweet);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * ブックマーク解除API
     *
     * @param  Tweet  $tweet
     * @param  UnBookMarkService  $unBookMarkService
     * @return JsonResponse
     */
    public function unBookMark(Tweet $tweet, UnBookmarkService $unBookMarkService): JsonResponse
    {
        $unBookMarkService->unBookMark($tweet);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
