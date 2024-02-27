<?php

namespace App\Http\Resources\Tweet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user'         => new TweetUserResource($this['tweet']),
            'tweet'        => new DetailResource($this['tweet']),
            'reply_tweets' => TweetListResource::collection($this['replyTweets']),
        ];
    }
}
