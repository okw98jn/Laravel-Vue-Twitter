<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\ShowResource;
use App\Http\Resources\User\UpdateResource;
use App\Http\Resources\User\UserTweetListResource;
use App\Models\User;
use App\Services\CommonService;

class UserController extends Controller
{
    /**
     * 指定されたユーザーの詳細情報とツイートの数を取得します。
     * ツイートのリストは、Eager Loadingを使用してn+1問題を解決します。
     *
     * @param  User  $user 詳細情報を取得するユーザー。
     * @return ShowResource ユーザーの詳細情報とそのユーザーのツイート数のレスポンスを返します。
     */
    public function show(User $user)
    {
        return new ShowResource($user);
    }

    /**
     * ユーザー情報を更新します。
     * アイコン画像とヘッダー画像は、'user/icon' と 'user/header' のパスに保存されます。
     *
     * @param  CommonService  $commonService 共通処理のサービスクラス。
     * @param  UpdateRequest  $request 更新リクエスト。バリデーション済みのリクエストデータを提供します。
     * @param  User  $user 更新対象のユーザー。
     * @return UpdateResource 更新されたユーザー情報のレスポンスを返します。
     */
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

    public function userTweetList(User $user)
    {
        return new UserTweetListResource($user);
    }
}
