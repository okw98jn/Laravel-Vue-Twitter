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
import { TweetForm } from '@/types/Tweet';

type Props = {
    user: AuthStore;
    toggleModal: () => void;
}

const { user, toggleModal } = defineProps<Props>();

const tweet = ref<TweetForm>({
    text: '',
    images: [] as string[],
    videos: [] as string[],
});

const tweetStore = useTweetStore();
const profileStore = useProfileStore();

const isLoading = ref(false);

const formData = new FormData();

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

const handleFileSelect = (event: Event) => {
    const file = (event.target as HTMLInputElement).files?.[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            if (file.type.startsWith('image/')) {
                const lastIndex = tweet.value.images.length;
                formData.append(`images[${lastIndex}]`, file);
                tweet.value.images.push((e.target as FileReader).result as string);
            } else if (file.type.startsWith('video/')) {
                const lastIndex = tweet.value.videos.length;
                formData.append(`videos[${lastIndex}]`, file);
                const videoUrl = URL.createObjectURL(file);
                tweet.value.videos.push(videoUrl);
            }
        };
        reader.readAsDataURL(file);
    }
};

const removeTweetFile = (index: number, type: 'images' | 'videos') => {
    tweet.value[type].splice(index, 1);
    formData.delete(`${type}[${index}]`);
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