<script setup lang="ts">
import image from '@/assets/test.png';
import Button from '@/components/ui/Button.vue';
import { ComputedRef, computed, ref } from 'vue';
import Modal from '@/components/ui/Modal.vue';
import InputCount from './InputCount.vue';
import TextAreaCount from './TextAreaCount.vue';
import { useUserStore } from '@/stores/user';
import { UserStore } from '@/types/User';

const isOpen = ref(false);

const handleModalOpen = (): void => {
    isOpen.value = true;
}

const handleModalClose = (): void => {
    isOpen.value = false;
}

const store = useUserStore();
const storeUser: ComputedRef<UserStore> = computed(() => store.user);

const user = computed(() => ({
    name: storeUser.value.data.name ?? '',
    introduction: storeUser.value.data.introduction ?? '',
    location: storeUser.value.data.location ?? '',
}));

</script>

<template>
    <div class="flex items-center justify-between py-4 -mt-20 px-4">
        <img :src="image" alt="image" class="w-32 h-32 object-cover rounded-full border-4 border-white">
        <div class="mt-12">
            <Button text="編集" @click="handleModalOpen"
                class-name="inline-flex items-center justify-center text-sm font-medium border bg-white h-10 px-4 py-2 mt-6 hover:bg-gray-200 " />
        </div>
        <Modal :isOpen="isOpen" title="プロフィール編集" @click="handleModalClose">
            <div class="w-full mx-auto py-2 px-4">
                <InputCount name="name" label="名前" placeholder="名前" maxCount="50" v-model="user.name" />
                <TextAreaCount name="introduction" label="自己紹介" placeholder="自己紹介" maxCount="160"
                    v-model="user.introduction" />
                <InputCount name="location" label="場所" placeholder="場所" maxCount="30" v-model="user.location" />
                <div class="flex justify-end">
                    <Button text="保存"
                        class-name="w-20 mt-4 inline-flex items-center justify-center h-10 px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-600" />
                </div>
            </div>
        </Modal>
    </div>
</template>