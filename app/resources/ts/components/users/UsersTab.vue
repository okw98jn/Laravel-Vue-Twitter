<script setup lang="ts">
import TabItem from '@/components/users/TabItem.vue';
</script>

<template>
    <div class="flex justify-around border-b">
        <TabItem routeName="UserList" title="すべてのユーザー" />
        <TabItem routeName="FollowList" title="フォロー" />
        <TabItem routeName="FollowerList" title="フォロワー" />
    </div>
    <RouterView />
</template>