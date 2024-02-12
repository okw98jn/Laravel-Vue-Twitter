import axiosClient from "@/axios";
import { User } from "@/types/User";
import { defineStore } from "pinia"
import { ref } from "vue"

export const useUserStore = defineStore('user', () => {
    const userList = ref<User[]>([]);
    const isLoading = ref(false);

    const fetchUsersFromEndpoint = async (endpoint: string, searchWord?: string) => {
        isLoading.value = true;

        try {
            const { data } = await axiosClient.get(endpoint, {
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

    const fetchUsers = (searchWord?: string) => fetchUsersFromEndpoint('/user/users', searchWord);

    const fetchFollowUsers = (userId: number | string, searchWord?: string) => {
        return fetchUsersFromEndpoint(`/user/${userId}/follow`, searchWord);
    }

    const fetchFollowerUsers = (userId: number | string, searchWord?: string) => {
        return fetchUsersFromEndpoint(`/user/${userId}/follower`, searchWord);
    }

    return {
        isLoading,
        userList,
        fetchUsers,
        fetchFollowUsers,
        fetchFollowerUsers,
    }
})