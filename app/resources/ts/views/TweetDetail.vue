<script setup lang="ts">
import TweetDetail from '@/components/tweet_detail/Tweet.vue';
import ReplyTweetCreate from '@/components/tweet_detail/ReplyTweetCreate.vue';
import Tweet from '@/components/tweet/Tweet.vue';
import { useTweetStore } from '@/stores/tweet';
import { computed, watch } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
let tweetId = route.params.tweetId as string;

const tweetStore = useTweetStore();
tweetStore.fetchTweetDetail(tweetId);

const tweet = computed(() => tweetStore.tweetDetail);
const isLoading = computed(() => tweetStore.isLoading);

watch(() => route.params.tweetId, (newTweetId) => {
    if (newTweetId !== tweetId) {
        tweetId = newTweetId as string;
        tweetStore.fetchTweetDetail(tweetId);
    }
});

</script>

<template>
    <div class="px-4 py-1">
        <h2 class="font-bold text-lg">ツイート</h2>
    </div>
    <div v-if="isLoading"></div>
    <TweetDetail v-else :user="tweet.user" :tweet="tweet.tweet" />
    <div :class="tweet.reply_tweets.length === 0 ? 'border-b' : ''">
        <ReplyTweetCreate v-if="tweet.tweet.id" :reply-tweet-id="tweet.tweet.id" />
    </div>
    <div class="pb-16">
        <template v-if="!isLoading && tweet.reply_tweets.length > 0">
            <Tweet v-for="reply_tweet in tweet.reply_tweets" :key="reply_tweet.tweet.id" :user="reply_tweet.user"
                :tweet="reply_tweet.tweet" />
        </template>
    </div>
</template>
