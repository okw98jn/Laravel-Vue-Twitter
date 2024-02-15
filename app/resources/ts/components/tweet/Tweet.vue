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
import axiosClient from "@/axios";
import RetweetButton from '@/components/tweet/RetweetButton.vue';
import ReplyButton from '@/components/tweet/ReplyButton.vue';
import TweetDelete from '@/components/tweet/TweetDelete.vue';
import { useRoute } from 'vue-router';
import Image from '@/components/tweet/Image.vue';
import Video from '@/components/tweet/Video.vue';
import BookmarkButton from '@/components/tweet/BookmarkButton.vue';

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

//ブックマークボタンをクリックした時の処理
const handleBookmark = async () => {
    try {
        const method = tweet.is_bookmarked ? 'delete' : 'post';
        await axiosClient[method](`/bookmark/${tweet.id}`);
        tweet.is_bookmarked = !tweet.is_bookmarked;
    } catch (err) {
        console.log(err);
    }
}

//リツイートボタンをクリックした時の処理
const handleRetweet = async () => {
    try {
        const method = tweet.is_retweeted ? 'delete' : 'post';
        await axiosClient[method](`/retweet/${tweet.id}`);
        tweet.is_retweeted = !tweet.is_retweeted;
        tweet.retweet_count += tweet.is_retweeted ? 1 : -1;
    } catch (err) {
        console.log(err);
    }
}
</script>

<template>
    <RouterLink :to="{ name: 'Home' }">
        <div class="border-b cursor-pointer hover:bg-gray-50 transition duration-300 ease-in-out">
            <div class="px-4 py-2">
                <div class="flex items-start space-x-4">
                    <div @click.prevent>
                        <UserIconImage :id="tweet.user_id" :icon_image="user.icon_image" />
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-center" @click.prevent>
                            <div class="mb-1">
                                <UserDetail :name="user.name" :user-id="user.user_id" :created="tweet.created"
                                    :id="tweet.user_id" />
                            </div>
                            <TweetDelete v-if="tweet.can_delete" :tweet-id="tweet.id" />
                        </div>
                        <Content :text="tweet.text" />
                        <div v-if="tweet.video_path" class="mt-2" @click.prevent>
                            <Video :path="tweet.video_path" />
                        </div>
                        <div v-if="tweet.images.length > 0" class="mt-2 grid grid-cols-2 gap-0.5">
                            <Image v-for="(image, index) in tweet.images" :key="index" :image-path="image.path" />
                        </div>
                        <div class="flex items-center justify-between text-gray-500 mt-2">
                            <div class="flex items-center space-x-6 text-gray-500" @click.prevent>
                                <ReplyButton :count="tweet.like_count" />
                                <RetweetButton :count="tweet.retweet_count" :is-retweeted="tweet.is_retweeted"
                                    @click="handleRetweet" />
                                <LikeButton :count="tweet.like_count" :is-liked-user="tweet.is_liked_user"
                                    @click="handleLike" />
                            </div>
                            <div @click.prevent>
                                <BookmarkButton :is-bookmarked="tweet.is_bookmarked" @click="handleBookmark" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </RouterLink>
</template>