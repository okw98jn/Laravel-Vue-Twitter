<script setup lang="ts">
import { onMounted } from 'vue';
import TweetList from '@/components/tweet/TweetList.vue';
import { useTweetStore } from '@/stores/tweet';
import { useRoute } from 'vue-router';

const tweetStore = useTweetStore();
const route = useRoute();

onMounted(async () => {
    const userId = route.params.userId as string;
    await tweetStore.fetchUserTweetList(userId);
});

const load = async function () {
    const userId = route.params.userId as string;
    await tweetStore.fetchUserTweetList(userId);
};

</script>

<template>
    <TweetList :load="load" />
</template>