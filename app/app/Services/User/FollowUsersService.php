<?php

namespace App\Services\User;

use App\Const\CommonConst;
use App\Models\User;

class FollowUsersService
{
    /**
     * フォローしているユーザー一覧を取得します
     *
     * @param  User  $user
     * @param  string  $searchWord
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFollowUsers(User $user, string $searchWord): \Illuminate\Pagination\LengthAwarePaginator
    {
        $users = $user->follows()->where(function ($query) use ($searchWord) {
            $query->where('name', 'like', "%$searchWord%")
                ->orWhere('user_id', 'like', "%$searchWord%")
                ->orWhere('introduction', 'like', "%$searchWord%");
        })->paginate(CommonConst::PAGE_MAX_COUNT);

        return $users;
    }
}
