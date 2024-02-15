<script setup lang="ts">
import { ArrowPathRoundedSquareIcon as OutlineIcon } from '@heroicons/vue/24/outline';
import { ArrowPathRoundedSquareIcon as SolidIcon } from '@heroicons/vue/24/solid';
import axiosClient from "@/axios";
import { ref } from 'vue';

type Props = {
    tweetId: number;
    countProp: number;
    isRetweetedProp: boolean;
}

const { tweetId, countProp, isRetweetedProp } = defineProps<Props>();

const isBookmarked = ref(isRetweetedProp);
const count = ref(countProp);

const handleRetweet = async () => {
    try {
        const method = isBookmarked.value ? 'delete' : 'post';
        await axiosClient[method](`/retweet/${tweetId}`);
        isBookmarked.value = !isBookmarked.value;
        count.value += isBookmarked.value ? 1 : -1;
    } catch (err) {
        console.log(err);
    }
}

</script>

<template>
    <div :class="`flex items-center hover:text-green-500`" @click="handleRetweet">
        <div class="p-1.5 rounded-full cursor-pointer transition duration-300 ease-in-out" :class="`hover:bg-green-100`">
            <SolidIcon v-if="isBookmarked" class="h-5 w-5 text-green-500" />
            <OutlineIcon v-else class="h-5 w-5" />
        </div>
        <span class="text-xs -ml-1">{{ count }}</span>
    </div>
</template>