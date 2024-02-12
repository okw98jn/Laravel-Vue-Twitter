<?php

namespace App\Http\Resources\Tweet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->resource->id,
            'user_id'       => $this->resource->user_id,
            'text'          => $this->resource->text,
            'like_count'    => $this->resource->likes->count(),
            'is_liked_user' => $this->resource->isLikedByUser(auth()->user()),
            'created'       => $this->resource->created_at->diffForHumans(),
            'can_delete'    => $this->resource->user_id === auth()->id(),
        ];
    }
}
