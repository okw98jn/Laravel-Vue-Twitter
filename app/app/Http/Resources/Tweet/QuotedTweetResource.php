<?php

namespace App\Http\Resources\Tweet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotedTweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->resource->id,
            'text'    => $this->resource->text,
            'images'  => TweetImageResource::collection($this->resource->tweetImages),
            'videos'  => TweetVideoResource::collection($this->resource->tweetVideos),
            'created' => $this->resource->created_at->diffForHumans(),
        ];
    }
}
