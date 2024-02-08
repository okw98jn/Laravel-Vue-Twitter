<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Response;

class TweetController extends Controller
{
    public function delete(Tweet $tweet)
    {
        $tweet->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
