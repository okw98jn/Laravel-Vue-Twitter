<script setup lang="ts">
import userImage from '@/assets/user.png';
import Button from '@/components/ui/Button.vue';
import { ComputedRef, computed, ref, watchEffect } from 'vue';
import Modal from '@/components/ui/Modal.vue';
import InputCount from './InputCount.vue';
import TextAreaCount from './TextAreaCount.vue';
import { useUserStore } from '@/stores/user';
import { UserStore } from '@/types/User';
import { CameraIcon } from "@heroicons/vue/24/outline";

const isOpen = ref(false);
const toggleModal = (): void => {
    isOpen.value = !isOpen.value;
    user.value.iconImage = storeUser.value.data.icon_image ?? '';
    user.value.headerImage = storeUser.value.data.header_image ?? '';
}

const store = useUserStore();
const storeUser: ComputedRef<UserStore> = computed(() => store.user);

const user = ref({
    name: '',
    introduction: '',
    location: '',
    iconImage: '',
    headerImage: '',
});

watchEffect(() => {
    user.value = {
        name: storeUser.value.data.name ?? '',
        introduction: storeUser.value.data.introduction ?? '',
        location: storeUser.value.data.location ?? '',
        iconImage: storeUser.value.data.icon_image ?? '',
        headerImage: storeUser.value.data.header_image ?? '',
    };
});

const fileInputIconImage = ref();
const fileInputHeaderImage = ref();

const selectIconImage = () => {
    fileInputIconImage.value.click();
};

const selectHeaderImage = () => {
    fileInputHeaderImage.value.click();
};

const handleImageSelect = (event: Event, imageProperty: 'headerImage' | 'iconImage') => {
    const file = (event.target as HTMLInputElement).files?.[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            user.value[imageProperty] = (e.target as FileReader).result as string;
        };
        reader.readAsDataURL(file);
    }
};

</script>

<template>
    <div class="flex items-center justify-between py-4 -mt-20 px-4">
        <img v-if="user.iconImage" :src="user.iconImage" alt="image"
            class="w-32 h-32 object-cover rounded-full border-4 border-white">
        <h2 v-else class="w-32 h-32 object-cover rounded-full border-4 border-white">
            <img :src="userImage" alt="user" class="rounded-full">
        </h2>
        <div class="mt-12">
            <Button text="編集" @click="toggleModal"
                class-name="inline-flex items-center justify-center text-sm font-medium border bg-white h-10 px-4 py-2 mt-6 hover:bg-gray-200 " />
        </div>
        <Modal :isOpen="isOpen" title="プロフィール編集" @click="toggleModal">
            <div class="mb-16">
                <div class="relative">
                    <img v-if="user.headerImage" :src="user.headerImage" alt="image"
                        class="w-full object-cover h-60 rounded-sm">
                    <h2 v-else class="w-full bg-gray-400 object-cover h-60 rounded-sm"></h2>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <CameraIcon @click="selectHeaderImage"
                            class="w-10 h-10 text-white bg-black p-2 rounded-full opacity-60 cursor-pointer hover:opacity-50 transition duration-300 ease-in-out " />
                        <input type="file" ref="fileInputHeaderImage"
                            @change="event => handleImageSelect(event, 'headerImage')" class="hidden" />
                    </div>
                </div>
                <div class="absolute top-56">
                    <img v-if="user.iconImage" :src="user.iconImage" alt="image"
                        class="ml-4 w-32 h-32 object-cover rounded-full border-4 border-white mt-4">
                    <h2 v-else class="ml-4 w-32 h-32 object-cover rounded-full border-4 border-white mt-4">
                        <img :src="userImage" alt="user" class="rounded-full">
                    </h2>
                    <div class="absolute top-[62px] left-[59px] flex items-center justify-center">
                        <CameraIcon @click="selectIconImage"
                            class="w-10 h-10 text-white bg-black p-2 rounded-full opacity-60 cursor-pointer hover:opacity-50 transition duration-300 ease-in-out " />
                        <input type="file" ref="fileInputIconImage" @change="event => handleImageSelect(event, 'iconImage')"
                            class="hidden" />
                    </div>
                </div>
            </div>
            <div class="w-full mx-auto py-2 px-4">
                <InputCount name="name" label="名前" placeholder="名前" maxCount="50" v-model="user.name" />
                <TextAreaCount name="introduction" label="自己紹介" placeholder="自己紹介" maxCount="160"
                    v-model="user.introduction" />
                <InputCount name="location" label="場所" placeholder="場所" maxCount="30" v-model="user.location" />
                <div class="flex justify-end w-full">
                    <div class="w-20">
                        <Button text="保存"
                            class-name="mt-4 inline-flex items-center justify-center h-10 px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-600" />
                    </div>
                </div>
            </div>
        </Modal>
    </div>
</template>