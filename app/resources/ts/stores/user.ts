import axiosClient from "@/axios";
import { User } from "@/types/User";
import { defineStore } from "pinia"
import { ref } from "vue"

export const useUserStore = defineStore('user', () => {
    const userList = ref<User[]>([]);
    const isLoading = ref(false);

    const fetchUsers = async (searchWord?: string) => {
        isLoading.value = true;

        try {
            const { data } = await axiosClient.get('/user/users', {
                params: {
                    search: searchWord
                }
            });
            userList.value = data.data;
        } catch (error: any) {
            throw error.response.data;
        } finally {
            isLoading.value = false;
        }

        return userList.value;
    }
    return {
        isLoading,
        userList,
        fetchUsers,
    }
})