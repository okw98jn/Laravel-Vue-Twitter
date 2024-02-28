<script setup lang="ts">
import TweetList from '@/components/tweet/TweetList.vue';
import { useTweetStore } from '@/stores/tweet';
import { useRoute } from 'vue-router';

const tweetStore = useTweetStore();
const route = useRoute();

const load = async () => {
    const userId = route.params.userId as string;
    await tweetStore.fetchUserTweetList(userId);
};

</script>

<template>
    <TweetList :load="load" :key="(route.params.userId as string)" />
</template>