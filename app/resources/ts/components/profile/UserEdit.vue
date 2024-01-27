<script setup lang="ts">
import image from '@/assets/test.png';
import Button from '@/components/ui/Button.vue';
import { ref } from 'vue';
import Modal from '@/components/ui/Modal.vue';

const isOpen = ref(false);

const handleClick = (): void => {
    isOpen.value = true;
}

const handleModalClose = (): void => {
    isOpen.value = false;
}


</script>

<template>
    <div class="flex items-center justify-between py-4 -mt-20 px-4">
        <img :src="image" :alt="image" class="w-32 h-32 object-cover rounded-full border-4 border-white">
        <div class="mt-12">
            <Button text="Edit profile" @click="handleClick"
                className="inline-flex rounded-full items-center justify-center text-sm font-medium border bg-white h-10 px-4 py-2 mt-6 hover:bg-gray-200 " />
        </div>
        <Modal :isOpen="isOpen" @click="handleModalClose">
            <div class="bg-gray-300">
                <p>テスト</p>
            </div>
        </Modal>
    </div>
</template>