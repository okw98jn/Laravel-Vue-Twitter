<?php

namespace App\Services\User;

use App\Models\User;

class FollowService
{
    /**
     * フォローします
     *
     * @param  User  $user
     * @return void
     */
    public function follow(User $user): void
    {
        $authUser = User::find(auth()->id());

        if ($authUser) {
            $authUser->follows()->attach($user);
        }
    }
}
