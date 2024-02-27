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
        if (! $this->user()) {
            return false;
        }

        $user = $this->route('user');

        return $this->user()->can('update', $user);
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
            'birthday'     => ['nullable'],
            'icon_image'   => ['nullable', 'image', 'file'],
            'header_image' => ['nullable', 'image', 'file'],
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
            'name'         => '名前',
            'introduction' => '自己紹介',
            'location'     => '場所',
            'icon_image'   => 'アイコン画像',
            'header_image' => 'ヘッダー画像',
        ];
    }
}
