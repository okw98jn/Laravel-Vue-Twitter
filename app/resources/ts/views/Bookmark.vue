<script setup lang="ts">
import Top from '@/components/bookmark/Top.vue';
import TweetList from '@/components/tweet/TweetList.vue';
import { useTweetStore } from '@/stores/tweet';
import { onMounted } from 'vue';

const tweetStore = useTweetStore();

onMounted(async () => {
    await tweetStore.fetchBookmarkList();
});

const load = async function () {
    await tweetStore.fetchBookmarkList();
};

</script>

<template>
    <Top />
    <TweetList :load="load" />
</template>