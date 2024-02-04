<script setup lang="ts">
import TabItem from './TabItem.vue';

</script>

<template>
    <div class="flex justify-around mt-4 border-b">
        <TabItem routeName="TweetList" title="ツイート" />
        <TabItem routeName="LikeList" title="いいね" />
    </div>
    <RouterView />
</template>