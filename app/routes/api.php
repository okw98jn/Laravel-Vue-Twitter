<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LikeController;
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
        Route::get('/{user}', [UserController::class, 'show']);
        Route::post('/{user}', [UserController::class, 'update']);
        Route::get('/{user}/tweets', [UserController::class, 'userTweetList']);
    });

    Route::prefix('like')->group(function () {
        Route::post('/{tweet}', [LikeController::class, 'like']);
        Route::delete('/{tweet}', [LikeController::class, 'unlike']);
    });
});
