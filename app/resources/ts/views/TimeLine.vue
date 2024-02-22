<script setup lang="ts">
import TweetList from '@/components/tweet/TweetList.vue';
import { useTweetStore } from '@/stores/tweet';

const tweetStore = useTweetStore();

const load = async () => {
    await tweetStore.fetchTweetList();
};

</script>

<template>
    <TweetList :load="load" />
</template>