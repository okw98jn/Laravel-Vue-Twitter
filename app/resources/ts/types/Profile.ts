export type Profile = {
    data: {
        id: number;
        name: string;
        user_id: string;
        introduction: string | null;
        location: string | null;
        birthday: string;
        icon_image: string | null;
        header_image: string | null;
        tweet_count: number;
        follow_count: number;
        follower_count: number;
        is_auth_user: boolean;
        is_follow: boolean;
        is_follower: boolean;
    },
};

export type UpdateProfile = {
    name: string;
    introduction: string | null;
    location: string | null;
    birthday: string;
    icon_image: string | null;
    header_image: string | null;
};