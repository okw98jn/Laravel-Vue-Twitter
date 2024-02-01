<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\ShowResource;

class UserController extends Controller
{
    public function show()
    {
        return new ShowResource(auth()->user());
    }

    public function update(UpdateRequest $request)
    {
        $file_name = $request->icon_image->getClientOriginalName();
        $request->icon_image->storeAs('public/', $file_name);
        $data = $request->validated();
        $user = auth()->user();

        $user->update($data);

        return new ShowResource($user);
    }
}
