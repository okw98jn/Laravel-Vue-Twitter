<script setup lang="ts">
import { computed, ref } from 'vue';
import { useTweetStore } from '@/stores/tweet';
import { useProfileStore } from '@/stores/profile';
import TweetText from '@/components/tweet_create/TweetText.vue';
import MediaItems from '@/components/tweet_create/MediaItems.vue';
import ReplyTweet from '@/components/tweet_create/ReplyTweet.vue';
import MediaButton from '@/components/tweet_create/MediaButton.vue';
import TweetButton from '@/components/tweet_create/TweetButton.vue';
import FooterLayout from '@/components/tweet_create/FooterLayout.vue';
import { useFileHandler } from '@/hooks/useFileHandler';
import { useAuthStore } from '@/stores/auth';
import { Tweet, TweetUser } from '@/types/Tweet';

type Props = {
    toggleModal: () => void;
    replyTweetIncrement: () => void;
    replyTweetUser: TweetUser;
    replyTweet: Tweet;
}

const { toggleModal, replyTweetIncrement, replyTweetUser, replyTweet } = defineProps<Props>();

const authStore = useAuthStore();
const user = computed(() => authStore.user);

const tweetStore = useTweetStore();
const profileStore = useProfileStore();

const { tweet, formData, handleFileSelect, removeTweetFile } = useFileHandler();

const isLoading = ref(false);

const storeTweet = () => {
    isLoading.value = true;

    formData.append('text', tweet.value.text);
    formData.append('reply_tweet_id', replyTweet.id.toString());

    tweetStore.storeTweet(formData)
        .then((data) => {
            profileStore.profile.data.tweet_count++;
            toggleModal();
            replyTweetIncrement();
            tweetStore.tweetDetail.reply_tweets.unshift(data);
        })
        .catch((err) => {
            console.log(err);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

</script>

<template>
    <ReplyTweet :reply-tweet-user="replyTweetUser" :reply-tweet="replyTweet" />
    <TweetText :user-icon="user.data.icon_image" v-model="tweet.text" />
    <MediaItems :images="tweet.images" :videos="tweet.videos" :remove-tweet-file="removeTweetFile" />
    <FooterLayout>
        <MediaButton :images="tweet.images" :videos="tweet.videos" :handle-file-select="handleFileSelect" />
        <TweetButton :storeTweet="storeTweet" :is-loading="isLoading" :tweet="tweet" />
    </FooterLayout>
</template>