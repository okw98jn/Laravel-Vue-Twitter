export type User = {
    id: number;
    name: string;
    user_id: string;
    introduction: string | null;
    icon_image: string | undefined;
    is_follow: boolean;
    is_follower: boolean;
};
