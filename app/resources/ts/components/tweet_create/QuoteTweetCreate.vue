<script setup lang="ts">
import { computed, ref } from 'vue';
import { useTweetStore } from '@/stores/tweet';
import { useProfileStore } from '@/stores/profile';
import TweetText from '@/components/tweet_create/TweetText.vue';
import MediaItems from '@/components/tweet_create/MediaItems.vue';
import QuoteTweet from '@/components/tweet_create/QuoteTweet.vue';
import MediaButton from '@/components/tweet_create/MediaButton.vue';
import TweetButton from '@/components/tweet_create/TweetButton.vue';
import FooterLayout from '@/components/tweet_create/FooterLayout.vue';
import { useFileHandler } from '@/hooks/useFileHandler';
import { useRoute } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import { Tweet, TweetUser } from '@/types/Tweet';

type Props = {
    toggleModal: () => void;
    quoteTweetUser: TweetUser;
    quoteTweet: Tweet;
}

const { toggleModal, quoteTweetUser, quoteTweet } = defineProps<Props>();

const authStore = useAuthStore();
const user = computed(() => authStore.user);

const tweetStore = useTweetStore();
const profileStore = useProfileStore();
const route = useRoute();

const { tweet, formData, handleFileSelect, removeTweetFile } = useFileHandler();

const isLoading = ref(false);

const storeTweet = () => {
    isLoading.value = true;

    formData.append('text', tweet.value.text);

    tweetStore.storeTweet(formData)
        .then((data) => {
            const isMyProfile = typeof route.params.userId === 'string' && parseInt(route.params.userId) === user.value.data.id;
            if ((route.name === 'UserTweetList' && isMyProfile) || route.name === 'TimeLine') {
                tweetStore.tweetList.unshift(data);
            }
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

</script>

<template>
    <TweetText :user-icon="user.data.icon_image" v-model="tweet.text" />
    <MediaItems :images="tweet.images" :videos="tweet.videos" :remove-tweet-file="removeTweetFile" />
    <QuoteTweet :quote-tweet-user="quoteTweetUser" :quote-tweet="quoteTweet" />
    <FooterLayout>
        <MediaButton :images="tweet.images" :videos="tweet.videos" :handle-file-select="handleFileSelect" />
        <TweetButton :storeTweet="storeTweet" :is-loading="isLoading" :tweet="tweet" />
    </FooterLayout>
</template>