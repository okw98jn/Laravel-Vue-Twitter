<?php

namespace App\Services\User;

use App\Models\User;

class IndexService
{
    public function getUsers()
    {
        return User::all();
    }
}
