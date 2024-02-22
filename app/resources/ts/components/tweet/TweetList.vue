<script setup lang="ts">
import Tweet from '@/components/tweet/Tweet.vue';
import { useTweetStore } from '@/stores/tweet';
import { TweetList } from '@/types/Tweet';
import { ComputedRef, computed, ref } from 'vue';
import { useInfiniteScroll } from '@/hooks/useInfiniteScroll';

type Props = {
    load: () => void;
    isLoading: boolean;
}

const { load, isLoading } = defineProps<Props>();

const tweetStore = useTweetStore();
const tweetList: ComputedRef<TweetList> = computed(() => tweetStore.tweetList);

//無限スクロール処理
const sentinel = ref(null);
const isLastPage = computed(() => tweetStore.pagination.current_page === tweetStore.pagination.last_page);
useInfiniteScroll(sentinel, isLastPage, load);

</script>

<template>
    <div v-if="isLoading" class="flex justify-center items-center h-64">
        <vue-element-loading :active="isLoading" spinner="ring" color="#6366F1" style="z-index: 1;" />
    </div>
    <div v-else class="pb-36">
        <Tweet v-for="tweet in tweetList" :key="tweet.tweet.id" :user="tweet.user" :tweet="tweet.tweet" />
    </div>
    <div ref="sentinel"></div>
</template>