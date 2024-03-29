<script setup lang="ts">
import { BookmarkIcon, HomeIcon, UserIcon } from "@heroicons/vue/24/outline"
import Button from '@/components/ui/Button.vue';
import { useAuthStore } from "@/stores/auth";
import { computed, ref } from "vue";
import { useRoute } from "vue-router";
import Modal from '@/components/ui/Modal.vue';
import User from '@/components/home/User.vue';
import { useTweetModalStore } from "@/stores/tweetModal";
import TweetCreate from "../tweet_create/TweetCreate.vue";

const tweetModalStore = useTweetModalStore();
const authStore = useAuthStore();
const authUser = computed(() => authStore.user);
const route = useRoute()
const navigation = computed(() => [
    {
        name: 'タイムライン',
        to: { name: 'TimeLine' },
        icon: HomeIcon,
        isActive: route.name === 'TimeLine' || route.name === 'FollowTweet',
    },
    {
        name: 'ブックマーク',
        to: { name: 'Bookmark' },
        icon: BookmarkIcon,
        isActive: route.name === 'Bookmark',
    },
    {
        name: 'プロフィール',
        to: {
            name: 'UserTweetList',
            params: { userId: (authUser.value.data.id) ?? 0 }
        },
        icon: UserIcon,
        isActive: route.name === 'UserTweetList' || route.name === 'LikeList' || route.name === 'UserList' || route.name === 'FollowList' || route.name === 'FollowerList',
    },
]);

const isOpen = ref(false);
const toggleModal = (): void => {
    isOpen.value = !isOpen.value;
    tweetModalStore.isTweetModalOpen = !tweetModalStore.isTweetModalOpen;
};

</script>

<template>
    <div class="flex justify-between items-center p-4">
        <div class="w-1/2"></div>
        <div class="w-1/2 h-screen flex flex-col justify-between pb-4">
            <div>
                <div class="mb-10">
                    <RouterLink :to="{ name: 'TimeLine' }">
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
                <Button text="ツイート" className="text-white bg-indigo-500 hover:bg-indigo-600" @click="toggleModal" />
                <Modal :isOpen="isOpen" title="" @click="toggleModal">
                    <TweetCreate :toggle-modal="toggleModal" />
                </Modal>
            </div>
            <User :user="authUser" />
        </div>
    </div>
</template>