<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * 認証済みユーザーが更新対象ユーザーの情報を更新できるかどうかを判断
     *
     * @param  User  $authUser  認証済みユーザー
     * @param  User  $updateUser  更新対象のユーザー
     * @return bool  認証済みユーザーが更新対象のユーザーかどうかを返す
     */
    public function update(User $authUser, User $updateUser): bool
    {
        return $authUser->id === $updateUser->id;
    }
}
