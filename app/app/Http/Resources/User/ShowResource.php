<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->resource;
        assert($user->relationLoaded('tweets'));

        return [
            'id'           => $user->id,
            'name'         => $user->name,
            'user_id'      => $user->user_id,
            'introduction' => $user->introduction,
            'location'     => $user->location,
            'birthday'     => $user->birthday,
            'icon_image'   => $user->icon_image ? env('MINIO_URL').$user->icon_image : null,
            'header_image' => $user->header_image ? env('MINIO_URL').$user->header_image : null,
            'tweet_const'  => $user->tweets->count(),
        ];
    }
}
