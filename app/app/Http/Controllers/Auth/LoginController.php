<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * ログインAPI
     *
     * @return AuthResource|Response
     */
    public function __invoke(LoginRequest $request): AuthResource|Response
    {
        if (! Auth::attempt($request->validated())) {
            return response([
                'loginFailure' => 'メールアドレスまたはパスワードが間違っています',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //これを書かないとエディターがエラーを出す
        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('AccessToken')->plainTextToken;
        $user->token = $token;

        return new AuthResource($user);
    }
}
