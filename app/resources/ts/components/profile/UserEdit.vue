<script setup lang="ts">
import userImage from '@/assets/user.png';
import Button from '@/components/ui/Button.vue';
import { ComputedRef, computed, ref, watchEffect } from 'vue';
import Modal from '@/components/ui/Modal.vue';
import InputCount from './InputCount.vue';
import TextAreaCount from './TextAreaCount.vue';
import { useProfileStore } from '@/stores/profile';
import { Profile, UpdateProfile } from '@/types/Profile';
import { CameraIcon } from "@heroicons/vue/24/outline";
import { useRoute } from 'vue-router';
import DateInput from './DateInput.vue';
import { useTweetStore } from '@/stores/tweet';
import FollowButton from '@/components/ui/FollowButton.vue';
import { useAuthStore } from '@/stores/auth';
import dayjs from 'dayjs';

const route = useRoute();
const userId = route.params.userId as string;

const profileStore = useProfileStore();
const tweetStore = useTweetStore();
const authStore = useAuthStore();

const profile: ComputedRef<Profile> = computed(() => profileStore.profile);
const isLoading: ComputedRef<boolean> = computed(() => profileStore.isLoading);

const isUpdateLoading = ref(false);

const user = ref<UpdateProfile>({
    name: '',
    introduction: '',
    location: '',
    birthday: '',
    icon_image: '',
    header_image: '',
});

watchEffect(() => {
    user.value = {
        name: profile.value.data.name ?? '',
        introduction: profile.value.data.introduction ?? '',
        location: profile.value.data.location ?? '',
        birthday: profile.value.data.birthday ?? '',
        icon_image: profile.value.data.icon_image ?? '',
        header_image: profile.value.data.header_image ?? '',
    };
});

const errorMessages = ref({
    name: '',
    introduction: '',
    location: '',
    birthday: '',
});

const formData = new FormData();

const updateUser = () => {
    isUpdateLoading.value = true;
    if (user.value.birthday) {
        formData.append('birthday', dayjs(user.value.birthday.replace(/年|月/g, '/').replace(/日/g, '')).format('YYYY-MM-DD'));
    } else {
        formData.append('birthday', '');
    }

    formData.append('name', user.value.name);
    formData.append('location', user.value.location ?? '');
    formData.append('introduction', user.value.introduction ?? '');

    profileStore.updateProfile(userId, formData)
        .then(() => {
            toggleModal();
            if (route.name === 'UserTweetList') {
                tweetStore.fetchUserTweetList(userId);
            } else {
                tweetStore.fetchUserLikedTweetList(userId);
            }
            tweetStore.tweetList = [];
            authStore.fetchUser();
        })
        .catch((err) => {
            errorMessages.value = err
        })
        .finally(() => {
            isUpdateLoading.value = false;
        });
};

const fileInputIconImage = ref();
const fileInputHeaderImage = ref();
const selectIconImage = () => {
    fileInputIconImage.value.click();
};
const selectHeaderImage = () => {
    fileInputHeaderImage.value.click();
};
const handleImageSelect = (event: Event, imageProperty: 'header_image' | 'icon_image') => {
    const file = (event.target as HTMLInputElement).files?.[0];
    if (file) {
        formData.append(imageProperty, file);
        const reader = new FileReader();
        reader.onload = (e) => {
            user.value[imageProperty] = (e.target as FileReader).result as string;
        };
        reader.readAsDataURL(file);
    }
};

const isOpen = ref(false);
const toggleModal = (): void => {
    isOpen.value = !isOpen.value;
    user.value = {
        name: profile.value.data.name ?? '',
        introduction: profile.value.data.introduction ?? '',
        location: profile.value.data.location ?? '',
        birthday: profile.value.data.birthday ?? '',
        icon_image: profile.value.data.icon_image ?? '',
        header_image: profile.value.data.header_image ?? '',
    };
    errorMessages.value = {
        name: '',
        introduction: '',
        location: '',
        birthday: '',
    };
};

</script>

<template>
    <div class="flex items-center justify-between py-4 -mt-20 px-4">
        <template v-if="isLoading"></template>
        <template v-else>
            <img v-if="user.icon_image" :src="user.icon_image" alt="image"
                class="w-32 h-32 object-cover rounded-full border-4 border-white">
            <h2 v-else class="w-32 h-32 object-cover rounded-full border-4 border-white">
                <img :src="userImage" alt="user" class="rounded-full">
            </h2>
        </template>
        <div class="mt-12">
            <Button v-if="profile.data.is_auth_user" text="編集" @click="toggleModal"
                class-name="inline-flex items-center justify-center text-sm font-medium border bg-white h-10 px-4 py-2 mt-6 hover:bg-gray-200 " />
            <div class="mt-6" v-if="profile.data.id !== 0 && !profile.data.is_auth_user">
                <FollowButton :isFollow="profile.data.is_follow" :target-user-id="userId" :user-id="profile.data.user_id" />
            </div>
        </div>
        <Modal :isOpen="isOpen" title="プロフィール編集" @click="toggleModal">
            <div class="mb-16">
                <div class="relative">
                    <img v-if="user.header_image" :src="user.header_image" alt="image"
                        class="w-full object-cover h-60 rounded-sm">
                    <h2 v-else class="w-full bg-slate-200 h-60 rounded-sm"></h2>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <CameraIcon @click="selectHeaderImage"
                            class="w-10 h-10 text-white bg-black p-2 rounded-full opacity-60 cursor-pointer hover:opacity-50 transition duration-300 ease-in-out " />
                        <input type="file" ref="fileInputHeaderImage" accept="image/*"
                            @change="event => handleImageSelect(event, 'header_image')" class="hidden" />
                    </div>
                </div>
                <div class="absolute top-56">
                    <img v-if="user.icon_image" :src="user.icon_image" alt="image"
                        class="ml-4 w-32 h-32 object-cover rounded-full border-4 border-white mt-4">
                    <h2 v-else class="ml-4 w-32 h-32 object-cover rounded-full border-4 border-white mt-4">
                        <img :src="userImage" alt="user" class="rounded-full">
                    </h2>
                    <div class="absolute top-[62px] left-[59px] flex items-center justify-center">
                        <CameraIcon @click="selectIconImage"
                            class="w-10 h-10 text-white bg-black p-2 rounded-full opacity-60 cursor-pointer hover:opacity-50 transition duration-300 ease-in-out " />
                        <input type="file" ref="fileInputIconImage" accept="image/*"
                            @change="event => handleImageSelect(event, 'icon_image')" class="hidden" />
                    </div>
                </div>
            </div>
            <div class="w-full mx-auto py-2 px-4">
                <InputCount name="name" label="名前" placeholder="名前" maxCount="50" v-model="user.name"
                    :error-message="errorMessages.name" />
                <TextAreaCount name="introduction" label="自己紹介" placeholder="自己紹介" maxCount="160"
                    :error-message="errorMessages.introduction" v-model="user.introduction" />
                <InputCount name="location" label="場所" placeholder="場所" maxCount="30" v-model="user.location"
                    :error-message="errorMessages.location" />
                <DateInput name="" label="生年月日" :error-message="errorMessages.birthday" v-model="user.birthday" />
                <div class="flex justify-end w-full">
                    <div class="w-20 mt-4">
                        <Button text="保存" @click="updateUser" :is-loading="isUpdateLoading"
                            className="h-10 text-white bg-indigo-500 hover:bg-indigo-600" />
                    </div>
                </div>
            </div>
        </Modal>
    </div>
</template>