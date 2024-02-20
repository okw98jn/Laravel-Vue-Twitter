<script setup lang="ts">
import { useAuthStore } from '@/stores/auth';
import SidebarLeft from '@/components/home/SidebarLeft.vue';
import { onMounted, ref } from 'vue';

const isLoading = ref(true);
const authStore = useAuthStore();

if (authStore.user.data.id === null) {
    authStore.fetchUser().then(() => {
        isLoading.value = false;
    });
}

onMounted(() => {
    if (authStore.user.data.id !== null) {
        isLoading.value = false;
    }
});

</script>

<template>
    <vue-element-loading :active="isLoading" spinner="line-scale" size="60" is-full-screen />
    <div class="flex h-screen overflow-auto">
        <div class="w-1/3 sticky top-0 border-r border-gray-200">
            <SidebarLeft />
        </div>
        <div class="w-1/3">
            <RouterView />
        </div>
        <div class="w-1/3 border-l border-gray-200 sticky top-0 -z-10">
            サイドバー(右)
        </div>
    </div>
</template>