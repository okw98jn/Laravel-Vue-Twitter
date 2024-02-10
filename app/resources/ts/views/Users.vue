<script setup lang="ts">
import Top from '@/components/users/Top.vue';
import UsersTab from '@/components/users/UsersTab.vue';
import { useUserStore } from '@/stores/user';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';

onMounted(async () => {
    const route = useRoute();
    const userId = route.params.userId as string;
    const userStore = useUserStore();
    await userStore.fetchProfile(userId);
});

</script>

<template>
    <Top />
    <UsersTab />
</template>