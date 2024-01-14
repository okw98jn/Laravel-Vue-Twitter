<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return new UserResource(Auth::user());
        }

        return response([
            'error' => 'メールアドレスまたはパスワードが間違っています',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
