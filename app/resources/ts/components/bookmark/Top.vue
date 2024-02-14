<script setup lang="ts">
import { useAuthStore } from "@/stores/auth";
import { computed } from "vue";

const authStore = useAuthStore();
const authUser = computed(() => authStore.user);
</script>

<template>
    <div class="px-4 py-1">
        <h2 class="font-bold text-lg">ブックマーク</h2>
        <span class="text-sm text-gray-500">{{ authUser.data.user_id }}</span>
    </div>
</template>