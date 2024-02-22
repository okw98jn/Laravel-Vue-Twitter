<script setup lang="ts">
import Top from '@/components/bookmark/Top.vue';
import TweetList from '@/components/tweet/TweetList.vue';
import { useTweetStore } from '@/stores/tweet';

const tweetStore = useTweetStore();

const load = async () => {
    await tweetStore.fetchBookmarkList();
};

</script>

<template>
    <Top />
    <TweetList :load="load" />
</template>