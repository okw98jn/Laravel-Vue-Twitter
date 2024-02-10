<script setup lang="ts">
import Tweet from '@/components/tweet/Tweet.vue';
import { useTweetStore } from '@/stores/tweet';
import { TweetList } from '@/types/Tweet';
import { ComputedRef, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';

const tweetStore = useTweetStore();
const tweetList: ComputedRef<TweetList> = computed(() => tweetStore.tweetList);
const isLoading: ComputedRef<boolean> = computed(() => tweetStore.isLoading);

onMounted(async () => {
    const route = useRoute();
    const userId = route.params.userId as string;
    await tweetStore.fetchUserLikedTweetList(userId);
});
</script>

<template>
    <div v-if="isLoading" class="flex justify-center items-center h-64">
        <vue-element-loading :active="isLoading" spinner="ring" color="#6366F1" style="z-index: 1;" />
    </div>
    <div v-else>
        <Tweet v-for="tweet in tweetList.tweets" :key="tweet.id" :user="tweetList.user" :tweet="tweet" />
    </div>
</template>