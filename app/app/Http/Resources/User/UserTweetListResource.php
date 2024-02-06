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
                'name'       => $this->name,
                'user_id'    => $this->user_id,
                'icon_image' => $this->icon_image ? env('MINIO_URL').$this->icon_image : null,
            ],
            'tweets' =>  UserTweetResource::collection($this->tweets),
        ];
    }
}
