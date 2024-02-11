<?php

namespace App\Http\Resources\Tweet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'       => $this->resource->user->name,
            'user_id'    => $this->resource->user->user_id,
            'icon_image' => $this->resource->user->icon_image ? env('IMAGE_URL').$this->resource->user->icon_image : null,
        ];
    }
}
