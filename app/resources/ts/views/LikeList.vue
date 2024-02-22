<script setup lang="ts">
import TweetList from '@/components/tweet/TweetList.vue';
import { useTweetStore } from '@/stores/tweet';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

const tweetStore = useTweetStore();
const route = useRoute();
const isLoading = ref(false);

onMounted(async () => {
    isLoading.value = true;
    const userId = route.params.userId as string;
    await tweetStore.fetchUserLikedTweetList(userId);
    isLoading.value = false;
});

const load = async () => {
    const userId = route.params.userId as string;
    await tweetStore.fetchUserLikedTweetList(userId);
};

</script>

<template>
    <TweetList :load="load" :is-loading="isLoading" />
</template>