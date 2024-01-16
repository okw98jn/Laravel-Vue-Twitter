<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\UserResource;
use App\Services\Auth\RegisterService;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct(private RegisterService $registerService)
    {
    }

    public function __invoke(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = $this->registerService->store($data);
        $credentials = [
            'email'    => $user->email,
            'password' => $data['password'],
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return new UserResource(Auth::user());
        }
    }
}
