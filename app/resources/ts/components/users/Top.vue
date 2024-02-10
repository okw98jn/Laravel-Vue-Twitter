<script setup lang="ts">
import { useUserStore } from "@/stores/user";
import { UserStore } from "@/types/User";
import { ArrowLeftIcon } from "@heroicons/vue/24/outline"
import { ComputedRef, computed } from "vue";

const userStore = useUserStore();
const user: ComputedRef<UserStore> = computed(() => userStore.user);

</script>

<template>
    <div class="flex items-center space-x-8 px-4 py-1">
        <RouterLink :to="{ name: 'TweetList' }">
            <ArrowLeftIcon class="h-6 w-6 cursor-pointer" />
        </RouterLink>
        <div>
            <h2 class="font-bold text-lg">{{ user.data.name }}</h2>
            <span class="text-sm text-gray-500">{{ user.data.user_id }}</span>
        </div>
    </div>
</template>