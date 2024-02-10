<script setup lang="ts">
import UserIconImage from '@/components/tweet/UserIconImage.vue';
import UserDetail from '@/components/tweet/UserDetail.vue';
import LikeButton from "@/components/tweet/LikeButton.vue";
import Content from "@/components/tweet/Content.vue";
import { Tweet, TweetUser } from "@/types/Tweet";
import { useAuthStore } from "@/stores/auth";
import { useTweetStore } from "@/stores/tweet";
import { ComputedRef, computed } from "vue";
import { AuthStore } from "@/types/Auth";
import ReplyButton from "./ReplyButton.vue";
import RetweetButton from "./RetweetButton.vue";
import axiosClient from "@/axios";
import TweetDelete from "./TweetDelete.vue";
import { useRoute } from 'vue-router';

type Props = {
    user: TweetUser;
    tweet: Tweet;
}

const { tweet, user } = defineProps<Props>();

const route = useRoute();
const userId = route.params.userId as string;

const authStore = useAuthStore();
const tweetStore = useTweetStore();

const storeAuthUser: ComputedRef<AuthStore> = computed(() => authStore.user);
const isAuthUser = computed(() => storeAuthUser.value.data.id === Number(userId));
const canTweetDelete = computed(() => storeAuthUser.value.data.id === Number(tweet.user_id));

//いいねボタンをクリックした時の処理
const handleLike = async () => {
    try {
        const method = tweet.is_liked_user ? 'delete' : 'post';
        await axiosClient[method](`/like/${tweet.id}`);
        tweet.is_liked_user = !tweet.is_liked_user;
        tweet.like_count += tweet.is_liked_user ? 1 : -1;

        if (tweet.is_liked_user === false && route.name === 'LikeList' && isAuthUser.value) {
            tweetStore.removeTweetById(tweet.id);
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
                        <div class="mb-1">
                            <UserDetail :name="user.name" :user-id="user.user_id" :created="tweet.created" />
                        </div>
                        <TweetDelete v-if="canTweetDelete" :tweet-id="tweet.id" />
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