<script setup lang="ts">
import { useUserStore } from '@/stores/user';
import SidebarLeft from './SidebarLeft.vue';

const store = useUserStore();
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