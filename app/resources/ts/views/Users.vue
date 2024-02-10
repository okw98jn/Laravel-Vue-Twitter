<script setup lang="ts">
import Top from '@/components/users/Top.vue';
import UsersTab from '@/components/users/UsersTab.vue';
import { useProfileStore } from '@/stores/profile';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';

onMounted(async () => {
    const route = useRoute();
    const userId = route.params.userId as string;
    const profileStore = useProfileStore();
    await profileStore.fetchProfile(userId);
});

</script>

<template>
    <Top />
    <UsersTab />
</template>