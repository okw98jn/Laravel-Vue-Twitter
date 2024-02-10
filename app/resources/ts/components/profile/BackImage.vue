<script setup lang="ts">
import { useProfileStore } from '@/stores/profile';
import { Profile } from '@/types/Profile';
import { ComputedRef, computed } from 'vue';

const profileStore = useProfileStore();
const profile: ComputedRef<Profile> = computed(() => profileStore.profile);
const isLoading: ComputedRef<boolean> = computed(() => profileStore.isLoading);
</script>

<template>
    <div v-if="isLoading" class="h-60"></div>
    <div v-else>
        <img v-if="profile.data.header_image" :src="profile.data.header_image" alt="image" class="w-full object-cover h-60">
        <h2 v-else class="w-full bg-slate-200 h-60 rounded-sm"></h2>
    </div>
</template>