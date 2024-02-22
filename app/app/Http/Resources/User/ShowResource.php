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
        return [
            'id'             => $this->resource->id,
            'name'           => $this->resource->name,
            'user_id'        => $this->resource->user_id,
            'introduction'   => $this->resource->introduction,
            'location'       => $this->resource->location,
            'birthday'       => $this->resource->birthday,
            'icon_image'     => $this->resource->icon_image ? env('IMAGE_URL').$this->resource->icon_image : null,
            'header_image'   => $this->resource->header_image ? env('IMAGE_URL').$this->resource->header_image : null,
            'tweet_count'    => $this->resource->tweets->count() + $this->resource->retweets->count(),
            'follow_count'   => $this->resource->follows->count(),
            'follower_count' => $this->resource->followers->count(),
            'is_auth_user'   => $this->resource->id === auth()->id(),
            'is_follow'      => $this->resource->followers->contains(auth()->id()),
            'is_follower'    => $this->resource->follows->contains(auth()->id()),
        ];
    }
}
