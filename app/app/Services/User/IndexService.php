<?php

namespace App\Services\User;

use App\Models\User;

class IndexService
{
    /**
     * ユーザー一覧を取得します
     *
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUsers()
    {
        return User::all();
    }
}
