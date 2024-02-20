<?php

namespace App\Services\Tweet;

use App\Models\Tweet;
use App\Models\TweetImage;
use App\Models\TweetVideo;
use App\Services\CommonService;

class StoreService extends TweetService
{
    /**
     * ツイートを保存
     *
     * @param  array<mixed>  $data
     * @return int
     */
    public function store(array $data): int
    {
        $data = [
            'user_id' => auth()->id(),
            'text'    => $data['text'] ?? null,
        ];

        return Tweet::create($data)->id;
    }

    /**
     * ツイート画像を保存
     *
     * @param  CommonService  $commonService
     * @param  int  $tweetId
     * @param  array<mixed>  $images
     * @return void
     */
    public function storeImages(CommonService $commonService, int $tweetId, array $images): void
    {
        $data = [];

        foreach ($images as $image) {
            $path = $commonService->savaFile(null, $image, 'tweet/image');

            $data[] = [
                'tweet_id' => $tweetId,
                'path'     => $path,
            ];
        }

        TweetImage::insert($data);
    }

    /**
     * ツイート動画を保存
     *
     * @param  CommonService  $commonService
     * @param  int  $tweetId
     * @param  array<mixed>  $videos
     * @return void
     */
    public function storeVideos(CommonService $commonService, int $tweetId, array $videos): void
    {
        $data = [];

        foreach ($videos as $video) {
            $path = $commonService->savaFile(null, $video, 'tweet/video');

            $data[] = [
                'tweet_id' => $tweetId,
                'path'     => $path,
            ];
        }

        TweetVideo::insert($data);
    }
}
