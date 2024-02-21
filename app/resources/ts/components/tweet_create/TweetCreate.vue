<script setup lang="ts">
import { AuthStore } from '@/types/Auth';
import { ref } from 'vue';
import { useTweetStore } from '@/stores/tweet';
import { useProfileStore } from '@/stores/profile';
import TweetText from '@/components/tweet_create/TweetText.vue';
import MediaItems from '@/components/tweet_create/MediaItems.vue';
import MediaButton from '@/components/tweet_create/MediaButton.vue';
import TweetButton from '@/components/tweet_create/TweetButton.vue';
import FooterLayout from '@/components/tweet_create/FooterLayout.vue';
import { useFileHandler } from '@/hooks/useFileHandler';

type Props = {
    user: AuthStore;
    toggleModal: () => void;
}

const { user, toggleModal } = defineProps<Props>();

const tweetStore = useTweetStore();
const profileStore = useProfileStore();

const { tweet, formData, handleFileSelect, removeTweetFile } = useFileHandler();

const isLoading = ref(false);

const storeTweet = () => {
    isLoading.value = true;

    formData.append('text', tweet.value.text);

    tweetStore.storeTweet(formData)
        .then(() => {
            profileStore.profile.data.tweet_count++;
            toggleModal();
        })
        .catch((err) => {
            console.log(err);
        })
        .finally(() => {
            isLoading.value = false;
        });
};
const setEmoji = (emoji: string) => {
    tweet.value.text += emoji;
};
const setGif = (gif: string) => {
    tweet.value.text += gif;
};
</script>

<template>
    <TweetText :user-icon="user.data.icon_image" v-model="tweet.text" />
    <MediaItems :images="tweet.images" :videos="tweet.videos" :remove-tweet-file="removeTweetFile" />
    <FooterLayout>
        <MediaButton :images="tweet.images" :videos="tweet.videos" :handle-file-select="handleFileSelect" />
        <TweetButton :storeTweet="storeTweet" :is-loading="isLoading" :tweet="tweet" />
    </FooterLayout>
</template>