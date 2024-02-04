import axiosClient from "@/axios";
import { AuthLogin, AuthRegister, AuthStore } from "@/types/Auth"
import { defineStore } from "pinia"
import { ref } from "vue"

export const useAuthStore = defineStore('auth', () => {

    const user = ref<AuthStore>({
        data: {
            id: null,
            name: '',
            email: '',
        },
        isLogin: sessionStorage.getItem('AUTH'),
    });

    const login = async (userData: AuthLogin) => {
        try {
            const { data } = await axiosClient.post('/login', userData);
            user.value.data = data.data;
            user.value.isLogin = 'true';
            sessionStorage.setItem('AUTH', 'true');
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
            sessionStorage.setItem('AUTH', 'true');
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
                name: '',
                email: '',
            };
            user.value.isLogin = null;
            sessionStorage.removeItem('AUTH');
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
            sessionStorage.removeItem('AUTH');
            console.error(error);
        }
    }

    return { user, login, register, logout, fetchUser }
})