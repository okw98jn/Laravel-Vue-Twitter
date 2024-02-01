<script setup lang="ts">
import { useUserStore } from '@/stores/user';
import { UserStore } from '@/types/User';
import { ComputedRef, computed } from 'vue';

const store = useUserStore();
const user: ComputedRef<UserStore> = computed(() => store.user);
</script>

<template>
    <div>
        <img v-if="user.data.header_image" :src="user.data.header_image" alt="image" class="w-full object-cover h-60">
        <h2 v-else class="w-full bg-slate-200 h-60 rounded-sm"></h2>
    </div>
</template>