<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\ShowResource;
use App\Http\Resources\User\UpdateResource;
use App\Models\User;
use App\Services\CommonService;

class UserController extends Controller
{
    public function show(User $user)
    {
        return new ShowResource($user->load('tweets'));
    }

    public function update(CommonService $commonService, UpdateRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->hasFile('icon_image')) {
            $data['icon_image'] = $commonService->savaFile($user->icon_image, $request->file('icon_image'), 'user/icon');
        }
        if ($request->hasFile('header_image')) {
            $data['header_image'] = $commonService->savaFile($user->header_image, $request->file('header_image'), 'user/header');
        }

        $user->update($data);

        return new UpdateResource($user);
    }
}
