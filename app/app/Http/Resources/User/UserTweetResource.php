<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'user_id' => $this->user_id,
            'text'    => $this->text,
            'likes'   => $this->likes->count(),
            'created' => $this->created_at->diffForHumans(),
        ];
    }
}
