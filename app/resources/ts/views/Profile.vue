<script setup lang="ts">
import Top from '@/components/profile/Top.vue';
import UserDetail from '@/components/profile/UserDetail.vue';
import UserEdit from '@/components/profile/UserEdit.vue';
import BackImage from '@/components/profile/BackImage.vue';
import { useProfileStore } from '@/stores/profile';
import { onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import TweetTab from '@/components/profile/TweetTab.vue';

const route = useRoute();
let userId = route.params.userId as string;

const profileStore = useProfileStore();

onMounted(async () => {
    await profileStore.fetchProfile(userId);
});

watch(() => route.params.userId, async (newUserId) => {
    if (newUserId !== userId) {
        userId = newUserId as string;
        await profileStore.fetchProfile(userId);
    }
});
</script>

<template>
    <Top />
    <BackImage />
    <UserEdit />
    <UserDetail />
    <TweetTab />
</template>