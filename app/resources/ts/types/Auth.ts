export type AuthStore = {
    data: {
        id: number | null;
        user_id: string;
        name: string;
        email: string;
        icon_image: string | undefined;
    }
    isLogin: string | null;
};

export type AuthRegister = {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
};

export type AuthLogin = {
    email: string;
    password: string;
};