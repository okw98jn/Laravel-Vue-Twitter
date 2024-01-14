export type UserState = {
    data: {
        id: number | null;
        name: string;
        email: string;
    }
    isLogin: string | null;
};

export type User = {
    name: string;
    email: string;
    imageUrl: string;
};

export type UserRegister = {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
};

export type UserLogin = {
    email: string;
    password: string;
};