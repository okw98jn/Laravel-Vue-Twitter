<script setup lang="ts">
import { Tweet, TweetUser } from '@/types/Tweet';
import userImage from '@/assets/user.png';
import { formatText } from '@/utils/formatText';

type Props = {
    replyTweetUser: TweetUser;
    replyTweet: Tweet;
}

const { replyTweetUser, replyTweet } = defineProps<Props>();

</script>

<template>
    <div class="w-full mb-2 cursor-default">
        <div class="flex items-stretch justify-between">
            <div class="flex flex-col items-center mr-4">
                <img v-if="replyTweetUser.icon_image" :src="replyTweetUser.icon_image" alt="user"
                    class="w-11 h-11 object-cover rounded-full">
                <img v-else :src="userImage" alt="user" class="w-11 h-11 object-cover rounded-full">
                <div class="w-0.5 rounded-md mt-2 flex-grow bg-gray-300"></div>
            </div>
            <div class="w-11/12">
                <span class="text-sm font-bold text-black mr-1">
                    {{ replyTweetUser.name }}
                </span>
                <span class="mr-1">
                    {{ replyTweetUser.user_id }}・
                </span>
                <span>
                    {{ replyTweet.created }}
                </span>
                <div class="text-black mb-8 overflow-auto break-all" v-html="formatText(replyTweet.text)"></div>
                <div v-if="replyTweet.images || replyTweet.videos" class="grid grid-cols-2 gap-2">
                    <div v-for="image in replyTweet.images">
                        <img :src="image.path" class="h-auto object-cover rounded-lg" />
                    </div>
                    <div v-for="video in replyTweet.videos">
                        <video :src="video.path" controls class="h-auto object-cover rounded-lg" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>