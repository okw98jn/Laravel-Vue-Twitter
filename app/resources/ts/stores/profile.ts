import axiosClient from "@/axios";
import { Profile } from "@/types/Profile";
import { defineStore } from "pinia"
import { ref } from "vue"

export const useProfileStore = defineStore('profile', () => {
    const profile = ref<Profile>({
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
            follow_count: 0,
            follower_count: 0,
            is_auth_user: false,
            is_follow: false,
        },
    });

    const isLoading = ref(false);

    const fetchProfile = async (userId: string) => {
        isLoading.value = true;

        try {
            const { data } = await axiosClient.get(`/user/${userId}`);
            profile.value.data = data.data;
        } catch (error: any) {
            throw error.response.data;
        } finally {
            isLoading.value = false;
        }

        return profile.value.data;
    }

    const updateProfile = async (userId: string, formData: FormData) => {
        await axiosClient.post(`/user/${userId}`, formData)
            .then((data) => {
                fetchProfile(data.data.data.id);
            })
            .catch((err) => {
                throw err.response.data;
            })

        return profile.value.data;
    }

    return {
        profile,
        isLoading,
        fetchProfile,
        updateProfile,
    }
})