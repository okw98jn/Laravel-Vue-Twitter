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
            'id'             => $this->resource->id,
            'user_id'        => $this->resource->user_id,
            'text'           => $this->resource->text,
            'like_count'     => $this->resource->likes->count(),
            'is_liked'       => $this->resource->is_liked ?? false,
            'retweet_count'  => $this->resource->retweets->count(),
            'is_retweeted'   => $this->resource->is_retweeted ?? false,
            'retweeted_user' => $this->resource->retweeted_user ?? null,
            'is_bookmarked'  => $this->resource->is_bookmarked ?? false,
            'created'        => $this->resource->created_at->diffForHumans(),
            'can_delete'     => $this->resource->user_id === auth()->id(),
            'images'         => TweetImageResource::collection($this->resource->tweetImages),
            'videos'         => TweetVideoResource::collection($this->resource->tweetVideos),
            'quote_tweet'    => $this->resource->quotedTweet ? [
                'user'  => new TweetUserResource($this->resource->quotedTweet),
                'tweet' => new QuotedTweetResource($this->resource->quotedTweet),
            ] : null,
        ];
    }
}
