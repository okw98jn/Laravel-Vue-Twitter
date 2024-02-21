<script setup lang="ts">
import { CameraIcon } from "@heroicons/vue/24/outline"
import { computed, ref } from "vue";

type Props = {
    images: string[];
    videos: string[];
    handleFileSelect: (event: Event) => void;
}

const { images, videos, handleFileSelect } = defineProps<Props>();

const canPushMediaButton = computed(() => {
    return (images.length + videos.length) >= 4;
});

const fileInputTweetFile = ref();

const selectTweetFiles = () => {
    if (canPushMediaButton.value) return;
    fileInputTweetFile.value.click();
};

</script>

<template>
    <div>
        <CameraIcon @click="selectTweetFiles"
            class="p-1.5 w-9 h-9 text-indigo-500 rounded-full hover:bg-indigo-100 transition duration-300 ease-in-out cursor-pointer"
            :class="canPushMediaButton ? 'hover:bg-white opacity-50 !cursor-default' : ''" />
        <input type="file" ref="fileInputTweetFile" accept="image/*,video/*" @change="event => handleFileSelect(event)"
            class="hidden" />
    </div>
</template>