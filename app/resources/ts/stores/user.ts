import axiosClient from "@/axios";
import { UserStore, UserTweetList } from "@/types/User";
import { defineStore } from "pinia"
import { ref } from "vue"

export const useUserStore = defineStore('user', () => {

    const user = ref<UserStore>({
        data: {
            id: 0,
            name: '',
            user_id: '',
            introduction: '',
            location: '',
            birthday: '',
            icon_image: '',
            header_image: '',
            tweet_count: 0,
        },
    });

    const userTweetList = ref<UserTweetList>({
        user: {
            name: '',
            user_id: '',
            icon_image: '',
        },
        tweets: [{
            id: 0,
            user_id: 0,
            text: '',
            like_count: 0,
            is_liked_user: false,
            created: '',
        }],
    });

    const isLoading = ref(false);
    const isTweetListLoading = ref(false);

    const fetchProfile = async (userId: string) => {
        isLoading.value = true;

        try {
            const { data } = await axiosClient.get(`/user/${userId}`);
            user.value.data = data.data;
        } catch (error: any) {
            throw error.response.data;
        } finally {
            isLoading.value = false;
        }

        return user.value.data;
    }

    const updateProfile = async (userId: string, formData: FormData) => {
        await axiosClient.post(`/user/${userId}`, formData)
            .then((data) => {
                fetchProfile(data.data.data.id);
                fetchUserTweetList(data.data.data.id);
            })
            .catch((err) => {
                throw err.response.data;
            })

        return user.value.data;
    }

    const fetchUserTweetList = async (userId: string) => {
        isTweetListLoading.value = true;

        try {
            // const { data } = await axiosClient.get(`/user/${userId}/tweets?page=2`);
            const { data } = await axiosClient.get(`/user/${userId}/tweets`);
            userTweetList.value = data.data;
        } catch (err: any) {
            throw err.response.data;
        } finally {
            isTweetListLoading.value = false;
        }

        return userTweetList.value;
    }
    return {
        user,
        isLoading,
        fetchProfile,
        updateProfile,
        userTweetList,
        fetchUserTweetList,
        isTweetListLoading,
    }
})