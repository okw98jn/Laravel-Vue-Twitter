export type TweetList = {
    user: TweetUser;
    tweet: Tweet;
}[];

export type TweetUser = {
    name: string;
    user_id: string;
    icon_image: string | undefined;
};

export type Tweet = {
    id: number;
    user_id: number;
    text: string | null;
    like_count: number;
    is_liked: boolean;
    retweet_count: number;
    reply_count: number;
    is_retweeted: boolean;
    retweeted_user: string | null;
    is_bookmarked: boolean;
    created: string;
    can_delete: boolean;
    images: {
        id: number;
        path: string;
    }[];
    videos: {
        id: number;
        path: string;
    }[];
    quote_tweet: QuoteTweet | null;
};

export type QuoteTweet = {
    user: TweetUser;
    tweet: {
        id: number;
        text: string | null;
        created: string;
        images: {
            id: number;
            path: string;
        }[];
        videos: {
            id: number;
            path: string;
        }[];
    };
}

export type TweetForm = {
    text: string;
    quoted_tweet_id?: string
    reply_tweet_id?: string
    images: string[];
    videos: string[];
};