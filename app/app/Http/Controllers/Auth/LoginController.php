<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return new AuthResource(Auth::user());
        }

        return response([
            'loginFailure' => 'メールアドレスまたはパスワードが間違っています',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
