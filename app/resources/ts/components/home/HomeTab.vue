<script setup lang="ts">
import TabItem from '@/components/ui/TabItem.vue';
</script>

<template>
    <div class="flex justify-around">
        <TabItem routeName="TimeLine" title="おすすめ" />
        <TabItem routeName="FollowTweet" title="フォロー中" />
    </div>
    <RouterView />
</template>