<script setup lang="ts">
import SidebarLeft from './SidebarLeft.vue';

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