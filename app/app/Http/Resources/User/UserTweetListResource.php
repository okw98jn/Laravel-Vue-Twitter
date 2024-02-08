<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTweetListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => [
                'name'       => $this->first()->user->name,
                'user_id'    => $this->first()->user->user_id,
                'icon_image' => $this->first()->user->icon_image ? env('IMAGE_URL').$this->first()->user->icon_image : null,
            ],
            'tweets' =>  UserTweetResource::collection($this),
        ];
    }
}
