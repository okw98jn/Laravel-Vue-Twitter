<script setup lang="ts">
import { Tweet, TweetUser } from '@/types/Tweet';
import userImage from '@/assets/user.png';

type Props = {
    quoteTweetUser: TweetUser;
    quoteTweet: Tweet;
}

const { quoteTweetUser, quoteTweet } = defineProps<Props>();

</script>

<template>
    <div class="flex items-start justify-between mb-4 cursor-default">
        <h2 class="mr-4">
        </h2>
        <div class="w-11/12 p-4 border rounded-2xl">
            <div class="flex items-center mb-2">
                <span class="mr-1">
                    <img v-if="quoteTweetUser.icon_image" :src="quoteTweetUser.icon_image" alt="user"
                        class="w-6 h-6 object-cover rounded-full">
                    <img v-else :src="userImage" alt="user" class="w-6 h-6 object-cover rounded-full">
                </span>
                <span class="text-sm font-bold text-black mr-1">
                    {{ quoteTweetUser.name }}
                </span>
                <span class="mr-1">
                    {{ quoteTweetUser.user_id }}・
                </span>
                <span>
                    {{ quoteTweet.created }}
                </span>
            </div>
            <div class="text-black mb-2 overflow-auto break-all">
                {{ quoteTweet.text }}
            </div>
            <div v-if="quoteTweet.images || quoteTweet.videos" class="grid grid-cols-2 gap-2">
                <div v-for="image in quoteTweet.images">
                    <img :src="image.path" class="h-auto object-cover rounded-lg" />
                </div>
                <div v-for="video in quoteTweet.videos">
                    <video :src="video.path" controls class="h-auto object-cover rounded-lg" />
                </div>
            </div>
        </div>
    </div>
</template>