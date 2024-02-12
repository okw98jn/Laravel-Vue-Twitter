<?php

namespace App\Services\User;

use App\Models\User;

class UnFollowService
{
    /**
     * フォローします
     *
     * @param  User  $user
     * @return void
     */
    public function unFollow(User $user): void
    {
        $authUser = User::find(auth()->id());

        if ($authUser) {
            $authUser->follows()->detach($user);
        }
    }
}
