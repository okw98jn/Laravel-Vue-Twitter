<script setup lang="ts">
import { ref } from 'vue';
import ModalImage from '@/components/ui/ModalImage.vue';

type Props = {
    imagePath: string;
}
const { imagePath } = defineProps<Props>();

const isOpen = ref(false);

const toggleModal = (): void => {
    isOpen.value = !isOpen.value;
};
</script>

<template>
    <img :src="imagePath" alt="tweet image" class="w-full h-auto object-cover rounded-lg" @click="toggleModal" />

    <ModalImage :isOpen="isOpen" @click="toggleModal">
        <img :src="imagePath" alt="tweet image" class="w-full h-auto object-cover rounded-lg" @click="toggleModal" />
    </ModalImage>
</template>
