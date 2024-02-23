import axiosClient from "@/axios";
import { Pagination } from "@/types/Pagination";
import { User } from "@/types/User";
import { defineStore } from "pinia"
import { ref } from "vue"

export const useUserStore = defineStore('user', () => {
    const userList = ref<User[]>([]);

    const pagination = ref<Pagination>({
        current_page: 0,
        next_page: 1,
        last_page: 1,
    });

    const isLoading = ref(false);

    const fetchUsersFromEndpoint = async (endpoint: string, searchWord?: string) => {
        isLoading.value = true;

        try {
            const { data } = await axiosClient.get(endpoint, {
                params: {
                    search: searchWord
                }
            });
            if (!data) {
                userList.value = [];
                return;
            }

            data.data.forEach((newUser: any) => {
                if (!userList.value.some((existingUser: any) => existingUser.id === newUser.id)) {
                    userList.value.push(newUser);
                }
            });


            pagination.value.current_page = data.meta.current_page;
            pagination.value.last_page = data.meta.last_page;
            if (data.links.next) {
                pagination.value.next_page = new URL(data.links.next).searchParams.get("page") as unknown as number;
            }

        } catch (error: any) {
            throw error.response.data;
        } finally {
            isLoading.value = false;
        }

        return userList.value;
    }

    const fetchUsers = (searchWord?: string) => {
        return fetchUsersFromEndpoint(`/user/users?page=${pagination.value.next_page}`, searchWord);
    };

    const fetchFollowUsers = (userId: number | string, searchWord?: string) => {
        return fetchUsersFromEndpoint(`/user/${userId}/follow?page=${pagination.value.next_page}`, searchWord);
    }

    const fetchFollowerUsers = (userId: number | string, searchWord?: string) => {
        return fetchUsersFromEndpoint(`/user/${userId}/follower?page=${pagination.value.next_page}`, searchWord);
    }

    const resetPagination = () => {
        pagination.value.current_page = 0;
        pagination.value.next_page = 1;
        pagination.value.last_page = 1;
        userList.value = [];
    }

    return {
        isLoading,
        userList,
        pagination,
        fetchUsers,
        fetchFollowUsers,
        fetchFollowerUsers,
        resetPagination,
    }
})