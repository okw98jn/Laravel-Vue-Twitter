<script setup lang="ts">
import { HeartIcon as HeartIconOutline } from '@heroicons/vue/24/outline';
import { HeartIcon as HeartIconSolid } from '@heroicons/vue/24/solid';
import axiosClient from "@/axios";
import { ComputedRef, computed, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import { useTweetStore } from '@/stores/tweet';
import { AuthStore } from '@/types/Auth';

type Props = {
    tweetId: number;
    countProp: number;
    isLikedUserProp: boolean;
}
const { tweetId, countProp, isLikedUserProp } = defineProps<Props>();

const route = useRoute();
const userId = route.params.userId as string;

const authStore = useAuthStore();
const tweetStore = useTweetStore();

const storeAuthUser: ComputedRef<AuthStore> = computed(() => authStore.user);
const isAuthUser = computed(() => storeAuthUser.value.data.id === Number(userId));

const isLikedUser = ref(isLikedUserProp);
const count = ref(countProp);

const handleLike = async () => {
    try {
        const method = isLikedUser.value ? 'delete' : 'post';
        await axiosClient[method](`/like/${tweetId}`);
        isLikedUser.value = !isLikedUser.value;
        count.value += isLikedUser.value ? 1 : -1;

        if (isLikedUser.value === false && route.name === 'LikeList' && isAuthUser.value) {
            tweetStore.removeTweetById(tweetId);
        }
    } catch (err) {
        console.log(err);
    }
}
</script>

<template>
    <div class="flex items-center hover:text-red-500" @click="handleLike">
        <div class="p-1.5 rounded-full cursor-pointer transition duration-300 ease-in-out" :class="`hover:bg-red-100`">
            <HeartIconSolid v-if="isLikedUser" class="h-5 w-5 text-rose-500" />
            <HeartIconOutline v-else class="h-5 w-5" />
        </div>
        <span class="text-xs -ml-1">{{ count }}</span>
    </div>
</template>
