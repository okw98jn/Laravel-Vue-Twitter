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

type Props = {
    user: TweetUser;
    tweet: Tweet;
}

const { tweet, user } = defineProps<Props>();

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
                        <div v-if="tweet.images.length > 0" class="mt-2 grid grid-cols-2 gap-0.5" @click.prevent>
                            <Image v-for="(image, index) in tweet.images" :key="index" :image-path="image.path" />
                        </div>
                        <div class="flex items-center justify-between text-gray-500 mt-2">
                            <div class="flex items-center space-x-6 text-gray-500" @click.prevent>
                                <ReplyButton :count="tweet.like_count" />
                                <RetweetButton :tweet-id="tweet.id" :count-prop="tweet.retweet_count"
                                    :is-retweeted-prop="tweet.is_retweeted" />
                                <LikeButton :tweet-id="tweet.id" :count-prop="tweet.like_count"
                                    :is-liked-user-prop="tweet.is_liked_user" />
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