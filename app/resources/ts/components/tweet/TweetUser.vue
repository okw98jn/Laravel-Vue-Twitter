<script setup lang="ts">
import UserDetail from '@/components/tweet/UserDetail.vue';
import { Tweet, TweetUser } from "@/types/Tweet";
import TweetDelete from '@/components/tweet/TweetDelete.vue';

type Props = {
    user: TweetUser;
    tweet: Tweet;
}

const { tweet, user } = defineProps<Props>();

</script>

<template>
    <div class="flex justify-between items-center">
        <div class="mb-1">
            <UserDetail :name="user.name" :user-id="user.user_id" :created="tweet.created" :id="tweet.user_id" />
            <p v-if="tweet.reply_user">
                <RouterLink :to="{ name: 'UserTweetList', params: { userId: tweet.reply_user.id } }">
                    <span class="text-indigo-500 hover:underline">
                        {{ tweet.reply_user.user_id }}
                    </span>
                </RouterLink>
                <span class="text-gray-500">
                    に返信
                </span>
            </p>
        </div>
        <TweetDelete v-if="tweet.can_delete" :tweet-id="tweet.id" />
    </div>
</template>