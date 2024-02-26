<script setup lang="ts">
import { QuoteTweet } from "@/types/Tweet";
import Video from '@/components/tweet/Video.vue';
import userImage from '@/assets/user.png';
import { formatText } from "@/utils/formatText";

type Props = {
    quoteTweet: QuoteTweet;
}

const { quoteTweet } = defineProps<Props>();

</script>

<template>
    <RouterLink :to="{ name: 'TweetDetail', params: { tweetId: quoteTweet.tweet.id } }">
        <div class="p-4 border rounded-2xl mt-2 hover:bg-gray-100 transition duration-300 ease-in-out">
            <div class="flex items-center mb-2">
                <span class="mr-1">
                    <img v-if="quoteTweet.user.icon_image" :src="quoteTweet.user.icon_image" alt="user"
                        class="w-6 h-6 object-cover rounded-full">
                    <img v-else :src="userImage" alt="user" class="w-6 h-6 object-cover rounded-full">
                </span>
                <span class="text-sm font-bold text-black mr-1">
                    {{ quoteTweet.user.name }}
                </span>
                <span class="mr-1 text-gray-500">
                    {{ quoteTweet.user.user_id }}・
                </span>
                <span class="text-gray-500">
                    {{ quoteTweet.tweet.created }}
                </span>
            </div>
            <div class="text-black mb-2 overflow-auto break-all" v-html="formatText(quoteTweet.tweet.text)">
            </div>
            <div v-if="quoteTweet.tweet.images || quoteTweet.tweet.videos" class="grid grid-cols-2 gap-2">
                <div v-for="image in quoteTweet.tweet.images">
                    <img :src="image.path" class="h-auto object-cover rounded-lg" />
                </div>
                <div v-for="video in quoteTweet.tweet.videos">
                    <video :src="video.path" controls class="h-auto object-cover rounded-lg" />
                </div>
            </div>
        </div>
    </RouterLink>
</template>