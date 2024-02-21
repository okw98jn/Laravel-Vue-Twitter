<script setup lang="ts">
import { computed } from "vue";
import Button from '@/components/ui/Button.vue';
import { TweetForm } from "@/types/Tweet";

type Props = {
    tweet: TweetForm;
    isLoading: boolean;
    storeTweet: () => void;
}

const { tweet, isLoading, storeTweet } = defineProps<Props>();

const canTweetButton = computed(() => {
    return tweet.text.length || tweet.images.length || tweet.videos.length;
});

</script>

<template>
    <div class="w-20">
        <Button text="ツイート" :disabled="!canTweetButton" @click="storeTweet" :is-loading="isLoading"
            :className="`h-10 my-3 text-white bg-indigo-500 hover:bg-indigo-600 ${!canTweetButton ? 'opacity-50 !cursor-default' : ''}`" />
    </div>
</template>