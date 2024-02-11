<?php

namespace App\Services\Auth;

use App\Models\User;

class RegisterService
{
    /**
     * ユーザーを新規登録します。
     */
    public function store(array $data): User
    {
        $data['password'] = bcrypt($data['password']);

        return User::create($data);
    }
}
