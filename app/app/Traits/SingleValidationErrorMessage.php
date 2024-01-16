<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

trait SingleValidationErrorMessage
{

    /**
     * バリデーションが失敗した場合に呼び出されるメソッド。
     *
     * @param Validator $validator バリデーション結果を保持するValidatorインスタンス
     * @throws HttpResponseException バリデーションエラーメッセージとHTTPステータス422を含む例外
     *
     * このメソッドは、バリデーションが失敗した場合に自動的に呼び出されます。
     * バリデーションエラーの各フィールドに対して、最初のエラーメッセージだけを取得し、
     * それらのメッセージを含むHTTPレスポンスを生成します。
     * このレスポンスは、HTTPステータスコード422（Unprocessable Entity）とともに、
     * HttpResponseExceptionとしてスローされます。
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors());
        $messages = $errors->map(function ($error_messages) {
            return $error_messages[0];
        });

        throw new HttpResponseException(response(
            $messages,
            Response::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
