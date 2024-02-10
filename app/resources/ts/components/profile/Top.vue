<script setup lang="ts">
import { useUserStore } from "@/stores/user";
import { UserStore } from "@/types/User";
import { ArrowLeftIcon } from "@heroicons/vue/24/outline"
import { ComputedRef, computed } from "vue";

const store = useUserStore();
const user: ComputedRef<UserStore> = computed(() => store.user);

</script>

<template>
    <div class="flex items-center space-x-2 p-4">
        <RouterLink :to="{ name: 'Home' }">
            <ArrowLeftIcon class="h-6 w-6 cursor-pointer" />
        </RouterLink>
        <span class="text-sm">{{ user.data.tweet_count }} ツイート</span>
    </div>
</template>