<script setup lang="ts">
import Top from '@/components/profile/Top.vue';
import UserDetail from '@/components/profile/UserDetail.vue';
import UserEdit from '@/components/profile/UserEdit.vue';
import BackImage from '@/components/profile/BackImage.vue';
import { useProfileStore } from '@/stores/profile';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import TweetTab from '@/components/profile/TweetTab.vue';

onMounted(async () => {
    const route = useRoute();
    const userId = route.params.userId as string;
    const profileStore = useProfileStore();
    await profileStore.fetchProfile(userId);
});

</script>

<template>
    <Top />
    <BackImage />
    <UserEdit />
    <UserDetail />
    <TweetTab />
</template>