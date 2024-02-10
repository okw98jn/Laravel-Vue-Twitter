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