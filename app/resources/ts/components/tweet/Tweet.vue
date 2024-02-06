<script setup lang="ts">
import { HeartIcon, ChatBubbleOvalLeftIcon, EllipsisHorizontalIcon, ArrowPathRoundedSquareIcon } from "@heroicons/vue/24/outline";
import UserIconImage from '@/components/tweet/UserIconImage.vue';
import UserDetail from '@/components/tweet/UserDetail.vue';
import IconButton from "@/components/tweet/IconButton.vue";
import Content from "@/components/tweet/Content.vue";
import { Tweet, TweetUser } from "@/types/User";
import { useAuthStore } from "@/stores/auth";
import { ComputedRef, computed } from "vue";
import { AuthStore } from "@/types/Auth";

type Props = {
    user: TweetUser;
    tweet: Tweet;
}
const { tweet, user } = defineProps<Props>();

const authStore = useAuthStore();
const storeAuthUser: ComputedRef<AuthStore> = computed(() => authStore.user);

const isAuthUser = computed(() => storeAuthUser.value.data.id === Number(tweet.user_id));
</script>

<template>
    <div class="border-b cursor-pointer hover:bg-gray-50 transition duration-300 ease-in-out">
        <div class="p-4">
            <div class="flex items-start space-x-4">
                <UserIconImage :icon_image="user.icon_image" />
                <div class="flex-1">
                    <div class="flex justify-between">
                        <UserDetail :name="user.name" :user-id="user.user_id" :created="tweet.created" />
                        <EllipsisHorizontalIcon v-if="isAuthUser" class="h-7 w-7 text-gray-500" />
                    </div>
                    <Content :text="tweet.text" />
                    <div class="flex items-center space-x-6 text-gray-500 mt-2">
                        <IconButton color="indigo" count="11">
                            <ChatBubbleOvalLeftIcon class="h-5 w-5" />
                        </IconButton>
                        <IconButton color="green" count="11">
                            <ArrowPathRoundedSquareIcon class="h-5 w-5" />
                        </IconButton>
                        <IconButton color="red" count="11">
                            <HeartIcon class="h-5 w-5" />
                        </IconButton>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>