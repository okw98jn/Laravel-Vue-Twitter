<script setup lang="ts">
import { useProfileStore } from "@/stores/profile";
import { Profile } from "@/types/Profile";
import { formatText } from "@/utils/formatText";
import { MapPinIcon } from "@heroicons/vue/24/outline";
import { CalendarIcon } from "@heroicons/vue/24/outline";
import { ComputedRef, computed } from "vue";

const profileStore = useProfileStore();
const profile: ComputedRef<Profile> = computed(() => profileStore.profile);
const isLoading: ComputedRef<boolean> = computed(() => profileStore.isLoading);
</script>

<template>
    <div v-if="isLoading" class="flex justify-center items-center h-40">
        <vue-element-loading :active="isLoading" spinner="ring" color="#6366F1" style="z-index: 1;" />
    </div>
    <div v-else class="text-left px-4">
        <div class="text-lg font-semibold">{{ profile.data.name }}</div>
        <div class="text-gray-500 mb-4">
            {{ profile.data.user_id }}
            <span v-if="profile.data.is_follower"
                class="bg-gray-200 inline-block text-gray-700 px-2 py-0.5 rounded-lg text-sm">フォローされています
            </span>
        </div>
        <div class="mb-2 overflow-auto break-words" v-html="formatText(profile.data.introduction)"></div>
        <div class="text-gray-500 text-sm my-3 flex items-center">
            <p class="mr-4 flex items-center">
                <span>
                    <MapPinIcon class="w-5 h-5 mr-1" />
                </span>
                <span>
                    {{ profile.data.location }}
                </span>
            </p>
            <p class="flex items-center">
                <span>
                    <CalendarIcon class="w-5 h-5 mr-1" />
                </span>
                <span>
                    {{ profile.data.birthday }}
                </span>
            </p>
        </div>
        <div class="flex items-center">
            <RouterLink :to="{ name: 'FollowList' }" class="mr-3">
                <p class="text-sm hover:underline">
                    <span class="font-medium">{{ profile.data.follow_count }}</span>
                    <span class="text-gray-500">フォロー</span>
                </p>
            </RouterLink>
            <RouterLink :to="{ name: 'FollowerList' }">
                <p class="text-sm hover:underline">
                    <span class="font-medium">{{ profile.data.follower_count }}</span>
                    <span class="text-gray-500">フォロワー</span>
                </p>
            </RouterLink>
        </div>
    </div>
</template>