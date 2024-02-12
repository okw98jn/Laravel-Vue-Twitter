<script setup lang="ts">
import TabItem from '@/components/ui/TabItem.vue';
</script>

<template>
    <div class="flex justify-around border-b">
        <TabItem routeName="AllTweet" title="おすすめ" />
        <TabItem routeName="FollowTweet" title="フォロー中" />
    </div>
    <RouterView />
</template>