<script setup lang="ts">
import Tweet from '@/components/tweet/Tweet.vue';
import { useTweetStore } from '@/stores/tweet';
import { TweetList } from '@/types/Tweet';
import { ComputedRef, computed, onBeforeUnmount, onMounted, ref } from 'vue';

type Props = {
    load: () => void;
}

const { load } = defineProps<Props>();

const tweetStore = useTweetStore();
const tweetList: ComputedRef<TweetList> = computed(() => tweetStore.tweetList);
const isLoading: ComputedRef<boolean> = computed(() => tweetStore.isLoading);
const isLastPage = computed(() => tweetStore.pagination.current_page === tweetStore.pagination.last_page);

//無限スクロール処理
//TODO 一瞬スクロールが上に戻るのを防ぐ
const sentinel = ref(null);
let observer: IntersectionObserver | null = null;

onMounted(async () => {
    observer = new IntersectionObserver(entries => {
        if (entries[0].isIntersecting && !isLastPage.value) {
            load();
        }
    }, {});

    if (sentinel.value) {
        observer.observe(sentinel.value);
    }
});

onBeforeUnmount(() => {
    observer?.disconnect();
});

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