<script setup lang="ts">
import { BookmarkIcon as BookmarkIconOutline } from '@heroicons/vue/24/outline';
import { BookmarkIcon as BookmarkIconSolid } from '@heroicons/vue/24/solid';
import axiosClient from "@/axios";
import { ref } from 'vue';
import notify from "@/hooks/useToast";

type Props = {
    tweetId: number;
    isBookmarkedProp: boolean;
}
const { tweetId, isBookmarkedProp } = defineProps<Props>();

const isBookmarked = ref(isBookmarkedProp);

const handleBookmark = async () => {
    try {
        const method = isBookmarked.value ? 'delete' : 'post';
        await axiosClient[method](`/bookmark/${tweetId}`);
        isBookmarked.value = !isBookmarked.value;
        const message = isBookmarked.value ? 'ブックマークしました' : 'ブックマークを解除しました';
        notify(message, 'info');
    } catch (err) {
        console.log(err);
    }
}

</script>

<template>
    <div :class="`flex items-center hover:text-indigo-500`" @click="handleBookmark">
        <div class="p-1.5 rounded-full cursor-pointer transition duration-300 ease-in-out" :class="`hover:bg-indigo-100`">
            <BookmarkIconSolid v-if="isBookmarked" class="h-5 w-5 text-indigo-500" />
            <BookmarkIconOutline v-else class="h-5 w-5" />
        </div>
    </div>
</template>
