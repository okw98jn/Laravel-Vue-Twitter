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
            'id'           => $this->id,
            'name'         => $this->name,
            'user_id'      => $this->user_id,
            'introduction' => $this->introduction,
            'location'     => $this->location,
            'birthday'     => $this->birthday,
            'icon_image'   => $this->icon_image ? env('MINIO_URL').$this->icon_image : null,
            'header_image' => $this->header_image ? env('MINIO_URL').$this->header_image : null,
        ];
    }
}
