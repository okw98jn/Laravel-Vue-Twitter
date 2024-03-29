<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->resource->id,
            'user_id'    => $this->resource->user_id,
            'name'       => $this->resource->name,
            'email'      => $this->resource->email,
            'icon_image' => $this->resource->icon_image ? env('IMAGE_URL').$this->resource->icon_image : null,
            'token'      => $this->resource->token,
        ];
    }
}
