<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tweet\StoreRequest;
use App\Http\Resources\Tweet\TweetListResource;
use App\Http\Resources\Tweet\TweetResource;
use App\Http\Resources\Tweet\TweetUserResource;
use App\Models\Tweet;
use App\Models\User;
use App\Services\CommonService;
use App\Services\Tweet\BookmarkTweetsService;
use App\Services\Tweet\FollowingTweetsService;
use App\Services\Tweet\IndexService;
use App\Services\Tweet\StoreService;
use App\Services\Tweet\UserLikedTweetsService;
use App\Services\Tweet\UserTweetsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
     * ブックマークしたツイート一覧API
     *
     * @param  BookmarkTweetsService  $bookmarkTweetsService
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function bookmarkTweets(BookmarkTweetsService $bookmarkTweetsService): AnonymousResourceCollection|JsonResponse
    {
        $bookMarkTweets = $bookmarkTweetsService->getBookmarkTweets();

        if ($bookMarkTweets->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return TweetListResource::collection($bookMarkTweets);
    }

    /**
     * ツイート投稿API
     *
     * @param  CommonService  $commonService
     * @param  StoreRequest  $request
     * @param  StoreService  $storeService
     * @return JsonResponse
     */
    public function store(CommonService $commonService, StoreRequest $request, StoreService $storeService): JsonResponse
    {
        $data = $request->validated();
        $tweet = null;

        DB::transaction(function () use ($storeService, $commonService, $data, &$tweet) {
            $tweet = $storeService->store($data);

            if (isset($data['images'])) {
                $storeService->storeImages($commonService, $tweet->id, $data['images']);
            }

            if (isset($data['videos'])) {
                $storeService->storeVideos($commonService, $tweet->id, $data['videos']);
            }
        });

        return response()->json([
            'user'   => new TweetUserResource($tweet),
            'tweet'  => new TweetResource($tweet),
        ], Response::HTTP_CREATED);
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

        DB::transaction(function () use ($tweet) {
            foreach ($tweet->tweetImages ?? [] as $image) {
                Storage::delete($image->path);
            }

            foreach ($tweet->tweetVideos ?? [] as $video) {
                Storage::delete($video->path);
            }

            $tweet->delete();
        });

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
