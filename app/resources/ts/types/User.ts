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
        tweet_count: number;
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
