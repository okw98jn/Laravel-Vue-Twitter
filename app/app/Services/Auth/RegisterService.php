<?php

namespace App\Services\Auth;

use App\Models\User;

class RegisterService
{
    public function store(array $data): User
    {
        $data['password'] = bcrypt($data['password']);

        return User::create($data);
    }
}
