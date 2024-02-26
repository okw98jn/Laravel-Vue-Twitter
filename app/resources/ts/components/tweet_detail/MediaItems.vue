<script setup lang="ts">
import { useTweetModalStore } from "@/stores/tweetModal";
import { XMarkIcon } from "@heroicons/vue/24/outline"
import { computed } from "vue";

type Props = {
    images: string[];
    videos: string[];
    removeTweetFile: (index: number, type: 'images' | 'videos') => void;
}

const { images, videos, removeTweetFile } = defineProps<Props>();

//左サイドバーツイート作成モーダルが開いているかどうかを確認するためのストア
const tweetModalStore = useTweetModalStore();
const isTweetModalOpen = computed(() => tweetModalStore.isTweetModalOpen);

</script>

<template>
    <div v-if="images || videos" class="grid grid-cols-2 gap-2 mb-4">
        <div v-for="(image, index) in images" class="relative" :class="{ '-z-10': isTweetModalOpen }">
            <img :src="image" class="h-auto object-cover rounded-lg" />
            <XMarkIcon @click="removeTweetFile(index, 'images')"
                class="absolute top-1 right-1 w-8 h-8 p-1 text-white bg-black cursor-pointer transition duration-300 ease-in-out opacity-60 hover:opacity-50 rounded-full" />
        </div>
        <div v-for="(video, index) in videos" class="relative" :class="{ '-z-10': isTweetModalOpen }">
            <video :src="video" controls class="h-auto object-cover rounded-lg" />
            <XMarkIcon @click="removeTweetFile(index, 'videos')"
                class="absolute top-1 right-1 w-8 h-8 p-1 text-white bg-black cursor-pointer transition duration-300 ease-in-out opacity-60 hover:opacity-50 rounded-full" />
        </div>
    </div>
</template>