<script setup lang="ts">
import { ArrowPathRoundedSquareIcon as OutlineIcon } from '@heroicons/vue/24/outline';
import { PencilSquareIcon } from '@heroicons/vue/24/outline';
import { ArrowPathRoundedSquareIcon as SolidIcon } from '@heroicons/vue/24/solid';
import axiosClient from "@/axios";
import { computed, ref } from 'vue';
import DropdownMenu from '@/components/ui/DropdownMenu.vue';
import { useTweetModalStore } from '@/stores/tweetModal';
import Modal from '@/components/ui/Modal.vue';
import QuoteTweetCreate from '@/components/tweet_create/QuoteTweetCreate.vue';
import { Tweet, TweetUser } from '@/types/Tweet';

type Props = {
    user: TweetUser;
    tweet: Tweet;
    countProp: number;
    isRetweetedProp: boolean;
}

const { user, tweet, countProp, isRetweetedProp } = defineProps<Props>();

//左サイドバーツイート作成モーダルが開いているかどうかを確認するためのストア
const tweetModalStore = useTweetModalStore();
const isTweetModalOpen = computed(() => tweetModalStore.isTweetModalOpen);

const isBookmarked = ref(isRetweetedProp);
const count = ref(countProp);

const handleRetweet = async () => {
    try {
        const method = isBookmarked.value ? 'delete' : 'post';
        await axiosClient[method](`/retweet/${tweet.id}`);
        isBookmarked.value = !isBookmarked.value;
        count.value += isBookmarked.value ? 1 : -1;
        toggleDropdown();
    } catch (err) {
        console.log(err);
    }
}

const isDropdownOpen = ref(false);
const isModalOpen = ref(false);

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
}

const toggleModal = (): void => {
    isModalOpen.value = !isModalOpen.value;
};

const quoteTweetIncrement = () => {
    count.value++;
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
        <DropdownMenu :is-open="isDropdownOpen" top="top-0" left="-left-4" width="w-40" @mouseleave="toggleDropdown">
            <div class="hover:bg-gray-100 px-4 py-3 rounded-t-lg cursor-pointer">
                <p class="flex items-center" @click="handleRetweet">
                    <OutlineIcon class="h-5 w-5 mr-2" />
                    {{ isBookmarked ? 'リツイート解除' : 'リツイート' }}
                </p>
            </div>
            <div class="hover:bg-gray-100 px-4 py-3 rounded-b-lg cursor-pointer">
                <p class="flex items-center" @click="toggleModal">
                    <PencilSquareIcon class="h-5 w-5 mr-2" />
                    引用リツイート
                </p>
            </div>
        </DropdownMenu>
        <Modal :isOpen="isModalOpen" title="" @click="toggleModal">
            <QuoteTweetCreate :quote-tweet-user="user" :quote-tweet="tweet" :toggle-modal="toggleModal"
                :quoteTweetIncrement="quoteTweetIncrement" />
        </Modal>
    </div>
</template>
