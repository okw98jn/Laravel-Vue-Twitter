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
import { useRoute } from 'vue-router';

type Props = {
    user: AuthStore;
    toggleModal: () => void;
}

const { user, toggleModal } = defineProps<Props>();

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
            const isMyProfile = typeof route.params.userId === 'string' && parseInt(route.params.userId) === user.data.id;
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
    <FooterLayout>
        <MediaButton :images="tweet.images" :videos="tweet.videos" :handle-file-select="handleFileSelect" />
        <TweetButton :storeTweet="storeTweet" :is-loading="isLoading" :tweet="tweet" />
    </FooterLayout>
</template>