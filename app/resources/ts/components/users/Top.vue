<script setup lang="ts">
import { useProfileStore } from "@/stores/profile";
import { Profile } from "@/types/Profile";
import { ArrowLeftIcon } from "@heroicons/vue/24/outline"
import { ComputedRef, computed } from "vue";

const profileStore = useProfileStore();
const profile: ComputedRef<Profile> = computed(() => profileStore.profile);

</script>

<template>
    <div class="flex items-center space-x-8 px-4 py-1">
        <RouterLink :to="{ name: 'TweetList' }">
            <ArrowLeftIcon class="h-6 w-6 cursor-pointer" />
        </RouterLink>
        <div>
            <h2 class="font-bold text-lg">{{ profile.data.name }}</h2>
            <span class="text-sm text-gray-500">{{ profile.data.user_id }}</span>
        </div>
    </div>
</template>