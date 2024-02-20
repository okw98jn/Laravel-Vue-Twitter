<script setup lang="ts">
import { ArrowPathRoundedSquareIcon as OutlineIcon } from '@heroicons/vue/24/outline';
import { PencilSquareIcon } from '@heroicons/vue/24/outline';
import { ArrowPathRoundedSquareIcon as SolidIcon } from '@heroicons/vue/24/solid';
import axiosClient from "@/axios";
import { computed, ref } from 'vue';
import DropdownMenu from '@/components/ui/DropdownMenu.vue';
import { useTweetModalStore } from '@/stores/tweetModal';

type Props = {
    tweetId: number;
    countProp: number;
    isRetweetedProp: boolean;
}

const { tweetId, countProp, isRetweetedProp } = defineProps<Props>();

//左サイドバーツイート作成モーダルが開いているかどうかを確認するためのストア
const tweetModalStore = useTweetModalStore();
const isTweetModalOpen = computed(() => tweetModalStore.isTweetModalOpen);

const isBookmarked = ref(isRetweetedProp);
const count = ref(countProp);

const handleRetweet = async () => {
    try {
        const method = isBookmarked.value ? 'delete' : 'post';
        await axiosClient[method](`/retweet/${tweetId}`);
        isBookmarked.value = !isBookmarked.value;
        count.value += isBookmarked.value ? 1 : -1;
        toggleDropdown();
    } catch (err) {
        console.log(err);
    }
}

const isOpen = ref(false);

const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
}

</script>

<template>
    <div class="relative" :class="{ '-z-10': isTweetModalOpen }">
        <div class="flex items-center hover:text-green-500" @click="toggleDropdown">
            <div class="p-1.5 rounded-full cursor-pointer transition duration-300 ease-in-out"
                :class="`hover:bg-green-100`">
                <SolidIcon v-if="isBookmarked" class="h-5 w-5 text-green-500" />
                <OutlineIcon v-else class="h-5 w-5" />
            </div>
            <span class="text-xs -ml-1">{{ count }}</span>
        </div>
        <DropdownMenu :is-open="isOpen" top="top-0" left="-left-4" width="w-40" @mouseleave="toggleDropdown">
            <div class="hover:bg-gray-100 px-4 py-3 rounded-t-lg">
                <p class="flex items-center" @click="handleRetweet">
                    <OutlineIcon class="h-5 w-5 mr-2" />
                    {{ isBookmarked ? 'リツイート解除' : 'リツイート' }}
                </p>
            </div>
            <div class="hover:bg-gray-100 px-4 py-3 rounded-b-lg">
                <p class="flex items-center">
                    <PencilSquareIcon class="h-5 w-5 mr-2" />
                    引用リツイート
                </p>
            </div>
        </DropdownMenu>
    </div>
</template>
