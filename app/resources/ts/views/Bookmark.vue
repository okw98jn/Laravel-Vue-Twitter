<script setup lang="ts">
import Top from '@/components/bookmark/Top.vue';
import TweetList from '@/components/tweet/TweetList.vue';
import { useTweetStore } from '@/stores/tweet';
import { onMounted, ref } from 'vue';

const tweetStore = useTweetStore();
const isLoading = ref(false);

onMounted(async () => {
    isLoading.value = true;
    await tweetStore.fetchBookmarkList();
    isLoading.value = false;
});

const load = async () => {
    await tweetStore.fetchBookmarkList();
};

</script>

<template>
    <Top />
    <TweetList :load="load" :is-loading="isLoading" />
</template>