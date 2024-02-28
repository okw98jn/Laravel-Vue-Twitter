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

</script>

<template>
    <video class="w-full h-96 object-cover rounded-lg" :class="{ '-z-10': isTweetModalOpen }" controls
        :src="videoPath"></video>
</template>