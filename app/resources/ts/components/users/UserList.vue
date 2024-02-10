<script setup lang="ts">
import User from '@/components/users/User.vue';
import { ComputedRef } from 'vue';
import { computed, onMounted } from 'vue';
import { useUserStore } from '@/stores/user';
import { User as UserType } from '@/types/User';

const userStore = useUserStore();
const userList: ComputedRef<UserType[]> = computed(() => userStore.userList);
const isLoading: ComputedRef<boolean> = computed(() => userStore.isLoading);

onMounted(async () => {
    await userStore.fetchUsers();
});
</script>

<template>
    <div v-if="isLoading" class="flex justify-center items-center h-64">
        <vue-element-loading :active="isLoading" spinner="ring" color="#6366F1" style="z-index: 1;" />
    </div>
    <div v-else>
        <User v-for="user in userList" :key="user.id" :user="user" />
    </div>
</template>