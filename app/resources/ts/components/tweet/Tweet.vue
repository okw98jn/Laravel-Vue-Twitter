<script setup lang="ts">
import UserIconImage from '@/components/tweet/UserIconImage.vue';
import UserDetail from '@/components/tweet/UserDetail.vue';
import LikeButton from "@/components/tweet/LikeButton.vue";
import Content from "@/components/tweet/Content.vue";
import { Tweet, TweetUser } from "@/types/Tweet";
import RetweetButton from '@/components/tweet/RetweetButton.vue';
import ReplyButton from '@/components/tweet/ReplyButton.vue';
import TweetDelete from '@/components/tweet/TweetDelete.vue';
import Image from '@/components/tweet/Image.vue';
import Video from '@/components/tweet/Video.vue';
import BookmarkButton from '@/components/tweet/BookmarkButton.vue';
import { ArrowPathRoundedSquareIcon } from '@heroicons/vue/24/outline';

type Props = {
    user: TweetUser;
    tweet: Tweet;
}

const { tweet, user } = defineProps<Props>();

</script>

<template>
    <RouterLink :to="{ name: 'Home' }">
        <div class="border-t cursor-pointer hover:bg-gray-50 transition duration-300 ease-in-out">
            <div class="px-4 py-2">
                <div v-if="tweet.retweeted_user" class="px-6 mb-1 flex items-center text-gray-500">
                    <p class="mr-1">
                        <ArrowPathRoundedSquareIcon class="w-4 h-4" />
                    </p>
                    <p class="text-sm font-medium">{{ tweet.retweeted_user }}がリツーイト</p>
                </div>
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
                        <div v-if="tweet.images.length || tweet.videos.length" class="mt-2 grid grid-cols-2 gap-0.5"
                            @click.prevent>
                            <Image v-for="image in tweet.images" :key="image.id" :image-path="image.path" />
                            <Video v-for="video in tweet.videos" :key="video.id" :video-path="video.path" />
                        </div>
                        <div class="flex items-center justify-between text-gray-500 mt-2">
                            <div class="flex items-center space-x-6 text-gray-500" @click.prevent>
                                <ReplyButton :count="tweet.like_count" />
                                <RetweetButton :tweet-id="tweet.id" :count-prop="tweet.retweet_count"
                                    :is-retweeted-prop="tweet.is_retweeted" />
                                <LikeButton :tweet-id="tweet.id" :count-prop="tweet.like_count"
                                    :is-liked-user-prop="tweet.is_liked" />
                            </div>
                            <div @click.prevent>
                                <BookmarkButton :tweet-id="tweet.id" :is-bookmarked-prop="tweet.is_bookmarked" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </RouterLink>
</template>