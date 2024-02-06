<script setup lang="ts">
import Tweet from '@/components/tweet/Tweet.vue';
import { useUserStore } from '@/stores/user';
import { ComputedRef, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { UserTweetList } from "@/types/User";

const store = useUserStore();
const userTweetList: ComputedRef<UserTweetList> = computed(() => store.userTweetList);
const isLoading: ComputedRef<boolean> = computed(() => store.isTweetListLoading);

onMounted(async () => {
    const route = useRoute();
    const userId = route.params.userId as string;
    await store.fetchUserTweetList(userId);
});
</script>

<template>
    <div v-if="isLoading" class="flex justify-center items-center h-64">
        <vue-element-loading :active="isLoading" spinner="ring" color="#6366F1" style="z-index: 1;" />
    </div>
    <div v-else>
        <Tweet v-for="tweet in userTweetList.tweets" :key="tweet.id" :user="userTweetList.user" :tweet="tweet" />
    </div>
</template>