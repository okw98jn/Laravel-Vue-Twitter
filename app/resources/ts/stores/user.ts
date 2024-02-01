import axiosClient from "@/axios";
import { UpdateUser, UserStore } from "@/types/User";
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
        },
    });

    const isLoading = ref(false);

    const fetchProfile = async () => {
        isLoading.value = true;

        try {
            const { data } = await axiosClient.get('/user');
            user.value.data = data.data;
        } catch (error: any) {
            throw error.response.data;
        } finally {
            isLoading.value = false;
        }

        return user.value.data;
    }

    const updateProfile = async (formData: FormData) => {
        await axiosClient.post('/user', formData)
            .then(() => {
                fetchProfile();
            })
            .catch((err) => {
                throw err.response.data;
            })

        return user.value.data;
    }
    return { user, isLoading, fetchProfile, updateProfile }
})