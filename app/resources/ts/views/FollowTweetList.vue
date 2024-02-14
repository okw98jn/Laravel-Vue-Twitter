<script setup lang="ts">
import TweetList from '@/components/tweet/TweetList.vue';
import { useTweetStore } from '@/stores/tweet';
import { onMounted } from 'vue';

const tweetStore = useTweetStore();

onMounted(async () => {
    await tweetStore.fetchFollowingsTweetList();
});
</script>

<template>
    <TweetList />
</template>