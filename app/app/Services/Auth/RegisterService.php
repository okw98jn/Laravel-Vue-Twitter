<?php

namespace App\Services\Auth;

use App\Models\User;

class RegisterService
{
    /**
     * ユーザーを新規登録します
     *
     * @param  array<mixed>  $data
     * @return User
     */
    public function store(array $data): User
    {
        $data['password'] = bcrypt($data['password']);

        return User::create($data);
    }
}
