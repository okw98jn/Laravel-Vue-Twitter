export type AuthStore = {
    data: {
        id: number | null;
        name: string;
        email: string;
    }
    isLogin: string | null;
};

export type Auth = {
    name: string;
    email: string;
    imageUrl: string;
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