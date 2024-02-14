<script setup lang="ts">
import TweetList from '@/components/tweet/TweetList.vue';
import { useTweetStore } from '@/stores/tweet';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';

const tweetStore = useTweetStore();

onMounted(async () => {
    const route = useRoute();
    const userId = route.params.userId as string;
    await tweetStore.fetchUserTweetList(userId);
});
</script>

<template>
    <TweetList />
</template>