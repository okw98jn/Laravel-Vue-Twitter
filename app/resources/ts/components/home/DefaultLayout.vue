<script setup lang="ts">
import { useAuthStore } from '@/stores/auth';
import SidebarLeft from './SidebarLeft.vue';
import { onMounted, ref } from 'vue';

const isLoading = ref(true);
const store = useAuthStore();

if (store.user.data.id === null) {
    store.fetchUser().then(() => {
        isLoading.value = false;
    });
}

onMounted(() => {
    if (store.user.data.id !== null) {
        isLoading.value = false;
    }
});

</script>

<template>
    <vue-element-loading :active="isLoading" spinner="line-scale" size="60"  is-full-screen />
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