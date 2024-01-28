<script setup lang="ts">
import { useAuthStore } from '@/stores/auth';
import SidebarLeft from './SidebarLeft.vue';

const store = useAuthStore();
if (store.user.data.id === null) {
    store.fetchUser();
}

</script>

<template>
    <div class="flex h-screen overflow-auto">
        <div class="w-1/3 sticky top-0 border-r border-gray-200">
            <SidebarLeft />
        </div>
        <div class="w-1/3 ">
            <RouterView />
        </div>
        <div class="w-1/3 sticky top-0 border-l border-gray-200">
            サイドバー(右)
        </div>
    </div>
</template>