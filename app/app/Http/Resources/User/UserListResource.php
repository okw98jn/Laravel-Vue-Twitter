<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'user_id'      => $this->user_id,
            'introduction' => $this->introduction,
            'icon_image'   => $this->icon_image ? env('IMAGE_URL').$this->icon_image : null,
            'is_follow'    => true,
            'is_follower'  => true,
        ];
    }
}
