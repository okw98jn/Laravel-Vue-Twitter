<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\ShowResource;
use App\Http\Resources\User\UpdateResource;
use App\Http\Resources\User\UserListResource;
use App\Models\User;
use App\Services\CommonService;
use App\Services\User\FollowerUsersService;
use App\Services\User\FollowService;
use App\Services\User\FollowUsersService;
use App\Services\User\IndexService;
use App\Services\User\UnFollowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * ユーザー一覧API
     * 検索キーワードがリクエストに含まれている場合、ユーザー名と自己紹介文から検索を行います
     *
     * @param  Request  $request
     * @param  IndexService  $indexService
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(Request $request, IndexService $indexService): AnonymousResourceCollection|JsonResponse
    {
        $users = $indexService->getUsers($request->input('search') ?? '');
        if ($users->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return UserListResource::collection($users);
    }

    /**
     * フォロー一覧API
     * 検索キーワードがリクエストに含まれている場合、ユーザー名と自己紹介文から検索を行います
     *
     * @param  User  $user
     * @param  Request  $request
     * @param  FollowUsersService  $followUsersService
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function followUsers(User $user, Request $request, FollowUsersService $followUsersService): AnonymousResourceCollection|JsonResponse
    {
        $users = $followUsersService->getFollowUsers($user, $request->input('search') ?? '');
        if ($users->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return UserListResource::collection($users);
    }

    /**
     * フォロワー一覧API
     * 検索キーワードがリクエストに含まれている場合、ユーザー名と自己紹介文から検索を行います
     *
     * @param  User  $user
     * @param  Request  $request
     * @param  FollowerUsersService  $followerUsersService
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function followerUsers(User $user, Request $request, FollowerUsersService $followerUsersService): AnonymousResourceCollection|JsonResponse
    {
        $users = $followerUsersService->getFollowerUsers($user, $request->input('search') ?? '');
        if ($users->isEmpty()) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return UserListResource::collection($users);
    }

    /**
     * ユーザー情報取得API
     *
     * @param  User  $user
     * @return ShowResource
     */
    public function show(User $user): ShowResource
    {
        return new ShowResource($user);
    }

    /**
     * ユーザー情報更新API
     * アイコン画像とヘッダー画像は、'user/icon' と 'user/header' のパスに保存されます
     *
     * @param  CommonService  $commonService
     * @param  UpdateRequest  $request
     * @param  User  $user
     * @return UpdateResource
     */
    public function update(CommonService $commonService, UpdateRequest $request, User $user): UpdateResource
    {
        $data = $request->validated();

        if (isset($data['icon_image'])) {
            $data['icon_image'] = $commonService->savaFile($user->icon_image, $data['icon_image'], 'user/icon');
        }
        if (isset($data['header_image'])) {
            $data['header_image'] = $commonService->savaFile($user->header_image, $data['header_image'], 'user/header');
        }

        $user->update($data);

        return new UpdateResource($user);
    }

    /**
     * フォローAPI
     *
     * @param  FollowService  $followService
     * @param  User  $user
     * @return JsonResponse
     */
    public function follow(FollowService $followService, User $user): JsonResponse
    {
        $this->authorize('follow', $user);

        $followService->follow($user);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * フォロー解除API
     *
     * @param  UnFollowService  $unFollowService
     * @param  User  $user
     * @return JsonResponse
     */
    public function unFollow(UnFollowService $unFollowService, User $user): JsonResponse
    {
        $unFollowService->unFollow($user);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
