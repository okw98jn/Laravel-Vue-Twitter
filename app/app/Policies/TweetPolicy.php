<?php

namespace App\Policies;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TweetPolicy
{
    public function delete(User $user, Tweet $tweet): Response
    {
        return $this->authorize($user, $tweet);
    }

    private function authorize(User $user, Tweet $tweet): Response
    {
        return $user->id === $tweet->user_id
            ? Response::allow()
            : Response::deny('権限がありません');
    }
}
