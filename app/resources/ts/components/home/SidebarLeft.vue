<script setup lang="ts">
import { HomeIcon } from "@heroicons/vue/24/outline"
import { UserIcon } from "@heroicons/vue/24/outline";
import Button from '@/components/ui/Button.vue';
import { useAuthStore } from "@/stores/auth";
import { computed } from "vue";
import { useRoute } from "vue-router";

const authStore = useAuthStore();
const authUser = computed(() => authStore.user);
const route = useRoute()
const navigation = computed(() => [
    {
        name: 'タイムライン',
        to: { name: 'Home' },
        icon: HomeIcon,
        isActive: route.name === 'Home',
    },
    {
        name: 'プロフィール',
        to: {
            name: 'TweetList',
            params: { userId: (authUser.value.data.id) ?? 0 }
        },
        icon: UserIcon,
        isActive: route.name === 'TweetList' || route.name === 'LikeList' || route.name === 'UserList' || route.name === 'FollowList' || route.name === 'FollowerList',
    },
]);

</script>

<template>
    <div class="flex justify-between items-center p-4">
        <div class="w-1/2"></div>
        <div class="w-1/2">
            <div class="mb-10">
                <RouterLink :to="{ name: 'Home' }">
                    <div class="mb-4 px-1 cursor-pointer">
                        <span class="transition hover:bg-gray-200 rounded-full px-4 py-3">✘</span>
                    </div>
                </RouterLink>
                <div v-for="item in navigation" :key="item.name"
                    class="w-full mb-4 cursor-pointer px-4 py-2 transition duration-300 ease-in-out hover:bg-gray-200 rounded-full"
                    :class="{ 'bg-gray-200': item.isActive }">
                    <RouterLink :to="item.to">
                        <p class="text-xl flex items-center">
                            <span class="mr-4">
                                <component :is="item.icon" class="w-7" />
                            </span>
                            <span>{{ item.name }}</span>
                        </p>
                    </RouterLink>
                </div>
            </div>
            <Button text="ツイート" className="text-white bg-indigo-500 hover:bg-indigo-600" />
        </div>
    </div>
</template>