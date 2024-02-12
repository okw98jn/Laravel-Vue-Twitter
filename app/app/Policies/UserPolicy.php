<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

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

    /**
     * 自分自身をフォローできないようにする
     *
     * @param  User  $authUser  認証済みユーザー
     * @param  User  $user  フォロー対象のユーザー
     * @return Response  認証済みユーザーがフォロー対象のユーザーかどうかを返す
     */
    public function follow(User $authUser, User $user): Response
    {
        return $authUser->id !== $user->id
            ? Response::allow()
            : Response::deny('自分をフォローすることはできません');
    }
}
