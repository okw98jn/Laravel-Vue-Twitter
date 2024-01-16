import axiosClient from "@/axios";
import { UserLogin, UserRegister, UserStore } from "@/types/User"
import { defineStore } from "pinia"
import { ref } from "vue"

export const useUserStore = defineStore('user', () => {

    const user = ref<UserStore>({
        data: {
            id: null,
            name: '',
            email: '',
        },
        isLogin: sessionStorage.getItem('AUTH'),
    });

    const login = async (userData: UserLogin) => {
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

    const register = async (userData: UserRegister) => {
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
            console.error(error);
        }
    }

    return { user, login, register, logout, fetchUser }
})