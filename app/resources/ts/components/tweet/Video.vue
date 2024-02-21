<script setup lang="ts">
import { useTweetModalStore } from '@/stores/tweetModal';
import { ref, onMounted, computed } from 'vue';

type Props = {
    id: number;
    videoPath: string;
}
const { id, videoPath } = defineProps<Props>();

//左サイドバーツイート作成モーダルが開いているかどうかを確認するためのストア
const tweetModalStore = useTweetModalStore();
const isTweetModalOpen = computed(() => tweetModalStore.isTweetModalOpen);

const videoRef = ref<HTMLVideoElement | null>(null);

onMounted(() => {
    videoRef.value = document.getElementById('videoElement_' + id) as HTMLVideoElement;
});

const toggleVideoPlayback = () => {
    if (videoRef.value?.paused) {
        videoRef.value.play();
    } else {
        videoRef.value?.pause();
    }
};
</script>

<template>
    <video :id="`videoElement_${id}`" class="w-full h-96 object-cover rounded-lg" :class="{ '-z-10': isTweetModalOpen }"
        controls :src="videoPath" @click="toggleVideoPlayback"></video>
</template>