<script setup lang="ts">
import { computed, ref } from 'vue';
import { useTweetStore } from '@/stores/tweet';
import TweetText from '@/components/tweet_create/TweetText.vue';
import MediaItems from '@/components/tweet_detail/MediaItems.vue';
import MediaButton from '@/components/tweet_create/MediaButton.vue';
import TweetButton from '@/components/tweet_create/TweetButton.vue';
import { useFileHandler } from '@/hooks/useFileHandler';
import { useAuthStore } from '@/stores/auth';
import { useTweetModalStore } from '@/stores/tweetModal';

type Props = {
    replyTweetId: number;
}

const { replyTweetId } = defineProps<Props>();

const authStore = useAuthStore();
const user = computed(() => authStore.user);

const tweetStore = useTweetStore();

const { tweet, formData, handleFileSelect, removeTweetFile } = useFileHandler();

const isLoading = ref(false);

const storeTweet = () => {
    isLoading.value = true;

    formData.append('text', tweet.value.text);
    formData.append('reply_tweet_id', replyTweetId.toString());

    tweetStore.storeTweet(formData)
        .then((data) => {
            tweet.value.text = '';
            tweet.value.images = [];
            tweet.value.videos = [];
            tweetStore.tweetDetail.reply_tweets.unshift(data);
            tweetStore.tweetDetail.tweet.reply_count++;
        })
        .catch((err) => {
            console.log(err);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

//左サイドバーツイート作成モーダルが開いているかどうかを確認するためのストア
const tweetModalStore = useTweetModalStore();
const isTweetModalOpen = computed(() => tweetModalStore.isTweetModalOpen);

</script>

<template>
    <div class="px-4">
        <TweetText :user-icon="user.data.icon_image" v-model="tweet.text" />
        <MediaItems :images="tweet.images" :videos="tweet.videos" :remove-tweet-file="removeTweetFile" />
        <div class="flex items-center justify-between">
            <MediaButton :images="tweet.images" :videos="tweet.videos" :handle-file-select="handleFileSelect" />
            <div :class="{ '-z-10': isTweetModalOpen }">
                <TweetButton :storeTweet="storeTweet" :is-loading="isLoading" :tweet="tweet" />
            </div>
        </div>
    </div>
</template>