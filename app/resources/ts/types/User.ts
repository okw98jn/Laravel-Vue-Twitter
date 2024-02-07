export type UserStore = {
    data: {
        id: number;
        name: string;
        user_id: string;
        introduction: string | null;
        location: string | null;
        birthday: string;
        icon_image: string | null;
        header_image: string | null;
        tweet_const: number;
    },
};

export type UpdateUser = {
    name: string;
    introduction: string | null;
    location: string | null;
    birthday: string;
    icon_image: string | null;
    header_image: string | null;
};

export type UserTweetList = {
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
    likes: number;
    created: string;
};