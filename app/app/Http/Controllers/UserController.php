<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\ShowResource;
use App\Http\Resources\User\UpdateResource;
use App\Http\Resources\User\UserListResource;
use App\Models\User;
use App\Services\CommonService;
use App\Services\User\IndexService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * ユーザー一覧API
     * 検索キーワードがリクエストに含まれている場合、ユーザー名と自己紹介文から検索を行います
     * @param Request $request
     * @param IndexService $indexService
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(Request $request, IndexService $indexService): AnonymousResourceCollection|JsonResponse
    {
        $request = 1;
        $users = $indexService->getUsers();
        if ($users->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return UserListResource::collection($users);
    }

    /**
     * ユーザー情報取得API
     * @param User $user
     * @return ShowResource
     */
    public function show(User $user): ShowResource
    {
        return new ShowResource($user);
    }

    /**
     * ユーザー情報更新API
     * アイコン画像とヘッダー画像は、'user/icon' と 'user/header' のパスに保存されます
     * @param CommonService $commonService
     * @param UpdateRequest $request
     * @param User $user
     * @return UpdateResource
     */
    public function update(CommonService $commonService, UpdateRequest $request, User $user): UpdateResource
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
