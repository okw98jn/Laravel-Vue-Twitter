export type TweetList = {
    user: TweetUser;
    tweets: Tweet[];
};

export type TweetUser = {
    name: string;
    user_id: string;
    icon_image: string | undefined;
};

export type Tweet = {
    id: number;
    user_id: number;
    text: string;
    like_count: number;
    is_liked_user: boolean;
    created: string;
};