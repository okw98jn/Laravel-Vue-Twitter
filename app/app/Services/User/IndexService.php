<?php

namespace App\Services\User;

use App\Const\CommonConst;
use App\Models\User;

class IndexService
{
    /**
     * ユーザー一覧を取得します(ログインユーザーは除く)
     *
     * @param  string  $searchWord
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getUsers(string $searchWord): \Illuminate\Pagination\LengthAwarePaginator
    {
        $users = User::where(function ($query) use ($searchWord) {
            $query->where('name', 'like', "%$searchWord%")
                ->orWhere('user_id', 'like', "%$searchWord%")
                ->orWhere('introduction', 'like', "%$searchWord%");
        })->paginate(CommonConst::PAGE_MAX_COUNT);

        return $users;
    }
}
