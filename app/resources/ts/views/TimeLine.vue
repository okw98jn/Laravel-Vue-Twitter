<script setup lang="ts">
import TweetList from '@/components/tweet/TweetList.vue';
import { useTweetStore } from '@/stores/tweet';
import { onMounted, ref } from 'vue';

const tweetStore = useTweetStore();
const isLoading = ref(false);

onMounted(async () => {
    isLoading.value = true;
    await tweetStore.fetchTweetList();
    isLoading.value = false;
});

const load = async () => {
    await tweetStore.fetchTweetList();
};

</script>

<template>
    <TweetList :load="load" :is-loading="isLoading" />
</template>