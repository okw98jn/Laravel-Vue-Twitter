<script setup lang="ts">
import { ref, onMounted } from 'vue';

type Props = {
    id: number;
    videoPath: string;
}
const { id, videoPath } = defineProps<Props>();

let videoRef = ref<HTMLVideoElement | null>(null);

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
    <video :id="`videoElement_${id}`" class="w-full h-96 object-cover rounded-lg -z-1" controls :src="videoPath"
        @click="toggleVideoPlayback"></video>
</template>