<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\ShowResource;
use App\Http\Resources\User\UpdateResource;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        return new ShowResource($user);
    }

    public function update(UpdateRequest $request, User $user)
    {
        // $file_name = $request->icon_image->getClientOriginalName();
        // $request->icon_image->storeAs('public/', $file_name);
        $data = $request->validated();

        $user->update($data);

        return new UpdateResource($user);
    }
}
