<?php

namespace App\Http\Requests\Auth;

use App\Traits\SingleValidationErrorMessage;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use SingleValidationErrorMessage;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string'],
            'user_id'  => ['required', 'string', 'unique:users,user_id', 'regex:/^@.*/'],
            'birthday' => ['required'],
            'email'    => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name'     => '名前',
            'user_id'  => 'ユーザーID',
            'birthday' => '生年月日',
            'email'    => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }

    public function messages()
    {
        return [
            'user_id.regex' => 'ユーザーIDは@から始まる必要があります',
        ];
    }
}
