<script setup lang="ts">
import UserIconImage from '@/components/tweet/UserIconImage.vue';
import UserDetail from '@/components/tweet/UserDetail.vue';
import LikeButton from "@/components/tweet/LikeButton.vue";
import Content from "@/components/tweet/Content.vue";
import { Tweet, TweetUser } from "@/types/Tweet";
import { useAuthStore } from "@/stores/auth";
import { ComputedRef, computed } from "vue";
import { AuthStore } from "@/types/Auth";
import ReplyButton from "./ReplyButton.vue";
import RetweetButton from "./RetweetButton.vue";
import axiosClient from "@/axios";
import TweetDelete from "./TweetDelete.vue";

type Props = {
    user: TweetUser;
    tweet: Tweet;
}

const { tweet, user } = defineProps<Props>();

const authStore = useAuthStore();
const storeAuthUser: ComputedRef<AuthStore> = computed(() => authStore.user);
const isAuthUser = computed(() => storeAuthUser.value.data.id === Number(tweet.user_id));

//いいねボタンをクリックした時の処理
const handleLike = async () => {
    try {
        if (tweet.is_liked_user) {
            await axiosClient.delete(`/like/${tweet.id}`);
            tweet.is_liked_user = false;
            tweet.like_count--;
        } else {
            await axiosClient.post(`/like/${tweet.id}`);
            tweet.is_liked_user = true;
            tweet.like_count++;
        }
    } catch (err) {
        console.log(err);
    }
}

</script>

<template>
    <div class="border-b cursor-pointer hover:bg-gray-50 transition duration-300 ease-in-out">
        <div class="p-4">
            <div class="flex items-start space-x-4">
                <UserIconImage :icon_image="user.icon_image" />
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <UserDetail :name="user.name" :user-id="user.user_id" :created="tweet.created" />
                        <TweetDelete v-if="isAuthUser" :tweet-id="tweet.id" />
                    </div>
                    <Content :text="tweet.text" />
                    <div class="flex items-center space-x-6 text-gray-500 mt-2">
                        <ReplyButton :count="tweet.like_count" />
                        <RetweetButton :count="tweet.like_count" />
                        <LikeButton :count="tweet.like_count" :is-liked-user="tweet.is_liked_user" @click="handleLike" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>