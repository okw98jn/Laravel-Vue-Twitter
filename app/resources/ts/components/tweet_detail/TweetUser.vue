<script setup lang="ts">
import UserDetail from '@/components/tweet_detail/UserDetail.vue';
import { Tweet, TweetUser } from "@/types/Tweet";
import TweetDelete from '@/components/tweet_detail/TweetDelete.vue';

type Props = {
    user: TweetUser;
    tweet: Tweet;
}

const { tweet, user } = defineProps<Props>();

</script>

<template>
    <div class="flex-1">
        <div class="flex justify-between items-center">
            <div class="mb-1">
                <UserDetail :name="user.name" :user-id="user.user_id" :id="tweet.user_id" />
            </div>
            <TweetDelete v-if="tweet.can_delete" :tweet-id="tweet.id" />
        </div>
    </div>
</template>