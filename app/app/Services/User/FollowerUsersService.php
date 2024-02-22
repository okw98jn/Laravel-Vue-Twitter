<?php

namespace App\Services\User;

use App\Const\CommonConst;
use App\Models\User;

class FollowerUsersService
{
    /**
     * フォロワー一覧を取得します
     *
     * @param  User  $user
     * @param  string  $searchWord
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFollowerUsers(User $user, string $searchWord): \Illuminate\Pagination\LengthAwarePaginator
    {
        $users = $user->followers()->where(function ($query) use ($searchWord) {
            $query->where('name', 'like', "%$searchWord%")
                ->orWhere('user_id', 'like', "%$searchWord%")
                ->orWhere('introduction', 'like', "%$searchWord%");
        })
            ->with(['follows', 'followers'])
            ->paginate(CommonConst::PAGE_MAX_COUNT);

        foreach ($users as $user) {
            $user->is_follow = $user->followers->contains(auth()->id() ?? 0);
            $user->is_follower = $user->follows->contains(auth()->id() ?? 0);
        }

        return $users;
    }
}
