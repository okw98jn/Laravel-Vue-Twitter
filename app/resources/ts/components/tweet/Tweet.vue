<script setup lang="ts">
import UserIconImage from '@/components/tweet/UserIconImage.vue';
import LikeButton from "@/components/tweet/LikeButton.vue";
import Content from "@/components/tweet/Content.vue";
import { Tweet, TweetUser as TweetUserType } from "@/types/Tweet";
import RetweetButton from '@/components/tweet/RetweetButton.vue';
import ReplyButton from '@/components/tweet/ReplyButton.vue';
import BookmarkButton from '@/components/tweet/BookmarkButton.vue';
import QuoteTweet from '@/components/tweet/QuoteTweet.vue';
import RetweetUser from '@/components/tweet/RetweetUser.vue';
import TweetMedia from '@/components/tweet/TweetMedia.vue';
import TweetUser from '@/components/tweet/TweetUser.vue';

type Props = {
    user: TweetUserType;
    tweet: Tweet;
}

const { tweet, user } = defineProps<Props>();

</script>

<template>
    <!-- <RouterLink :to="{ name: 'Home' }"> -->
    <div class="border-t cursor-pointer hover:bg-gray-50 transition duration-300 ease-in-out">
        <div class="px-4 py-2">
            <RetweetUser v-if="tweet.retweeted_user" :retweeted-user="tweet.retweeted_user" />
            <div class="flex items-start space-x-4">
                <UserIconImage :id="tweet.user_id" :icon_image="user.icon_image" />
                <div class="flex-1">
                    <TweetUser :user="user" :tweet="tweet" />
                    <RouterLink :to="{ name: 'TweetDetail', params: { tweetId: tweet.id } }">
                        <Content :text="tweet.text" />
                    </RouterLink>
                    <TweetMedia v-if="tweet.images.length || tweet.videos.length" :tweet="tweet" />
                    <QuoteTweet v-if="tweet.quote_tweet" :quote-tweet="tweet.quote_tweet" />
                    <div class="flex items-center justify-between text-gray-500 mt-2">
                        <div class="flex items-center space-x-6 text-gray-500">
                            <ReplyButton :user="user" :tweet="tweet" :count-prop="tweet.reply_count" />
                            <RetweetButton :user="user" :tweet="tweet" :count-prop="tweet.retweet_count"
                                :is-retweeted-prop="tweet.is_retweeted" />
                            <LikeButton :tweet-id="tweet.id" :count-prop="tweet.like_count"
                                :is-liked-user-prop="tweet.is_liked" />
                        </div>
                        <div>
                            <BookmarkButton :tweet-id="tweet.id" :is-bookmarked-prop="tweet.is_bookmarked" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </RouterLink> -->
</template>