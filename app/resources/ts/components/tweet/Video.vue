<script setup lang="ts">
import { ref, onMounted } from 'vue';

type Props = {
    path: string;
}
const { path } = defineProps<Props>();

let videoRef = ref<HTMLVideoElement | null>(null);

onMounted(() => {
    videoRef.value = document.getElementById('videoElement') as HTMLVideoElement;
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
    <video id="videoElement" class="w-full h-96 object-cover rounded-lg" controls :src="path"
        @click="toggleVideoPlayback"></video>
</template>