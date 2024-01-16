<?php

namespace App\Http\Requests\Auth;

use App\Traits\SingleValidationErrorMessage;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'    => ['required', 'string', 'email'],
            'password' => ['required'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email'    => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}
