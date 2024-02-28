<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct(private RegisterService $registerService)
    {
    }

    /**
     * ユーザー登録API
     *
     * @param  RegisterRequest  $request
     * @return AuthResource|JsonResponse
     */
    public function __invoke(RegisterRequest $request): AuthResource|JsonResponse
    {
        $data = $request->validated();

        $user = $this->registerService->store($data);
        Auth::login($user);

        $token = $user->createToken('main')->plainTextToken;
        $user->token = $token;

        return new AuthResource($user);
    }
}
