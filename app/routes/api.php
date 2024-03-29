<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookMarkController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RetweetController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use App\Http\Resources\Auth\AuthResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', LoginController::class);
Route::post('/register', RegisterController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function () {
        return new AuthResource(Auth::user());
    });
    Route::post('logout', LogoutController::class);

    Route::prefix('user')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/{user}/follow', [UserController::class, 'followUsers']);
        Route::get('/{user}/follower', [UserController::class, 'followerUsers']);
        Route::post('/{user}/follow', [UserController::class, 'follow']);
        Route::delete('/{user}/un_follow', [UserController::class, 'unFollow']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::post('/{user}', [UserController::class, 'update']);
    });

    Route::prefix('tweet')->group(function () {
        Route::get('/', [TweetController::class, 'index']);
        Route::get('/following', [TweetController::class, 'followingTweets']);
        Route::get('/bookmark', [TweetController::class, 'bookmarkTweets']);
        Route::get('/{user}', [TweetController::class, 'userTweets']);
        Route::get('/detail/{tweet}', [TweetController::class, 'show']);
        Route::get('/liked/{user}', [TweetController::class, 'userLikedTweets']);
        Route::post('/', [TweetController::class, 'store']);
        Route::delete('/{tweet}', [TweetController::class, 'delete']);
    });

    Route::prefix('retweet')->group(function () {
        Route::post('/{tweet}', [RetweetController::class, 'retweet']);
        Route::delete('/{tweet}', [RetweetController::class, 'unRetweet']);
    });

    Route::prefix('bookmark')->group(function () {
        Route::post('/{tweet}', [BookMarkController::class, 'bookmark']);
        Route::delete('/{tweet}', [BookMarkController::class, 'unBookmark']);
    });

    Route::prefix('like')->group(function () {
        Route::post('/{tweet}', [LikeController::class, 'like']);
        Route::delete('/{tweet}', [LikeController::class, 'unlike']);
    });
});
