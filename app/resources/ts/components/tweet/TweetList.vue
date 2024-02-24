<script setup lang="ts">
import Tweet from '@/components/tweet/Tweet.vue';
import { useTweetStore } from '@/stores/tweet';
import { TweetList } from '@/types/Tweet';
import { ComputedRef, computed, ref } from 'vue';
import InfiniteLoading from "v3-infinite-loading";
import "v3-infinite-loading/lib/style.css";

type Props = {
    load: () => void;
}

const { load } = defineProps<Props>();

const tweetStore = useTweetStore();
const tweetList: ComputedRef<TweetList> = computed(() => tweetStore.tweetList);
const isLoading: ComputedRef<boolean> = computed(() => tweetStore.isLoading);



const infiniteLoad = ($state: any) => {
    const isLastPage = computed(() => tweetStore.pagination.current_page === tweetStore.pagination.last_page);
    if (isLastPage.value) {
        $state.complete();
        return;
    }
    load();
};
</script>

<template>
    <div class="pb-16">
        <Tweet v-for="tweet in tweetList" :key="tweet.tweet.id" :user="tweet.user" :tweet="tweet.tweet" />
    </div>
    <div v-if="isLoading" class="flex justify-center items-center">
        <vue-element-loading :active="isLoading" spinner="ring" color="#6366F1" style="z-index: 1;" />
    </div>
    <infinite-loading @infinite="infiniteLoad">
        <template #spinner>
            <span></span>
        </template>
        <template #complete>
            <span></span>
        </template>
    </infinite-loading>
</template>