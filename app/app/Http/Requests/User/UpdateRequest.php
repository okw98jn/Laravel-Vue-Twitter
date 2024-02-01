<?php

namespace App\Http\Requests\User;

use App\Traits\SingleValidationErrorMessage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'         => ['required', 'string', 'max:50'],
            'introduction' => ['nullable', 'string', 'max:160'],
            'location'     => ['nullable', 'string', 'max:30'],
            'icon_image'   => ['nullable', 'image'],
            'header_image' => ['nullable', 'image'],
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
            'name'         => '名前',
            'introduction' => '自己紹介',
            'location'     => '場所',
            'icon_image'   => 'アイコン画像',
            'header_image' => 'ヘッダー画像',
        ];
    }
}
