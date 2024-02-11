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
            'id'           => $this->resource->id,
            'name'         => $this->resource->name,
            'user_id'      => $this->resource->user_id,
            'introduction' => $this->resource->introduction,
            'icon_image'   => $this->resource->icon_image ? env('IMAGE_URL').$this->resource->icon_image : null,
            'is_follow'    => true,
            'is_follower'  => true,
        ];
    }
}
