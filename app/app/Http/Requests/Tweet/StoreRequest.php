<?php

namespace App\Http\Requests\Tweet;

use App\Traits\SingleValidationErrorMessage;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'text'            => ['nullable', 'string', 'max:140'],
            'quoted_tweet_id' => ['nullable', 'exists:tweets,id'],
            'reply_tweet_id'  => ['nullable', 'exists:tweets,id'],
            'images.*'        => ['nullable', 'image', 'file'],
            'videos.*'        => ['nullable', 'file'],
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
            'text'            => 'ツイート内容',
            'quoted_tweet_id' => '引用ツイートID',
            'reply_tweet_id'  => '返信ツイートID',
            'images'          => '画像',
            'videos'          => '動画',
        ];
    }
}
