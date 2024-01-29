<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\ShowResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        return new ShowResource(auth()->user());
    }
}
