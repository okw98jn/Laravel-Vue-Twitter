<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * ログアウトAPI
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        //これを書かないとエディターがエラーを出す
        /** @var User $user */
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json(true, JsonResponse::HTTP_OK);
    }
}
