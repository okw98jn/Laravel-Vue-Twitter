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
            'name'       => $this->user->name,
            'user_id'    => $this->user->user_id,
            'icon_image' => $this->user->icon_image ? env('IMAGE_URL').$this->user->icon_image : null,
        ];
    }
}
