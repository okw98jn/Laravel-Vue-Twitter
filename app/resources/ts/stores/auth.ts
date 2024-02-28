import axiosClient from "@/axios";
import { AuthLogin, AuthRegister, AuthStore } from "@/types/Auth"
import { defineStore } from "pinia"
import { ref } from "vue"

export const useAuthStore = defineStore('auth', () => {

    const user = ref<AuthStore>({
        data: {
            id: null,
            user_id: '',
            name: '',
            email: '',
            icon_image: '',
        },
        token: '',
        isLogin: localStorage.getItem('AUTH'),
    });

    const login = async (userData: AuthLogin) => {
        try {
            const { data } = await axiosClient.post('/login', userData);
            user.value.data = data.data;
            user.value.isLogin = 'true';
            user.value.token = data.data.token;
            localStorage.setItem('AUTH', 'true');
            return data;
        } catch (error: any) {
            throw error.response.data;
        }
    }

    const register = async (userData: AuthRegister) => {
        try {
            const { data } = await axiosClient.post('/register', userData);
            user.value.data = data.data;
            user.value.isLogin = 'true';
            localStorage.setItem('AUTH', 'true');
            return data;
        } catch (error: any) {
            throw error.response.data;
        }
    }

    const logout = async () => {
        try {
            await axiosClient.post('/logout');
            user.value.data = {
                id: null,
                user_id: '',
                name: '',
                email: '',
                icon_image: '',
            };
            user.value.isLogin = null;
            localStorage.removeItem('AUTH');
        } catch (error) {
            console.error(error);
        }
    }

    const fetchUser = async () => {
        try {
            const { data } = await axiosClient.get('/user');
            user.value.data = data.data;
            return data;
        } catch (error) {
            localStorage.removeItem('AUTH');
            console.error(error);
        }
    }

    return { user, login, register, logout, fetchUser }
})