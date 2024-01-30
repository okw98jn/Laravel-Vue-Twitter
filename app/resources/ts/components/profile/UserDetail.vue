<script setup lang="ts">
import { useUserStore } from "@/stores/user";
import { UserStore } from "@/types/User";
import { MapPinIcon } from "@heroicons/vue/24/outline";
import { CalendarIcon } from "@heroicons/vue/24/outline";
import { ComputedRef, computed } from "vue";

const store = useUserStore();
const user: ComputedRef<UserStore> = computed(() => store.user);
const isLoading: ComputedRef<boolean> = computed(() => store.isLoading);

</script>

<template>
    <div v-if="isLoading" class="flex justify-center items-center h-40">
        <vue-element-loading :active="isLoading" spinner="ring" color="#6366F1" />
    </div>
    <div v-else class="text-left px-4">
        <div class="text-lg font-semibold">{{ user.data.name }}</div>
        <div class="text-gray-500 mb-4">{{ user.data.user_id }}</div>
        <div class="mb-2">{{ user.data.introduction }}</div>
        <div class="text-gray-500 text-sm my-3 flex items-center">
            <p class="mr-4 flex items-center">
                <span>
                    <MapPinIcon class="w-5 h-5 mr-1" />
                </span>
                <span>
                    {{ user.data.location }}
                </span>
            </p>
            <p class="flex items-center">
                <span>
                    <CalendarIcon class="w-5 h-5 mr-1" />
                </span>
                <span>
                    {{ user.data.birthday }}
                </span>
            </p>
        </div>
        <div class="flex items-center">
            <RouterLink :to="{ name: 'Home' }" class="mr-3">
                <p class="text-sm border-b border-transparent hover:border-current">
                    <span class="font-medium">10</span>
                    <span class="text-gray-500">フォロー</span>
                </p>
            </RouterLink>
            <RouterLink :to="{ name: 'Home' }">
                <p class="text-sm border-b border-transparent hover:border-current">
                    <span class="font-medium">10</span>
                    <span class="text-gray-500">フォロワー</span>
                </p>
            </RouterLink>
        </div>
    </div>
</template>