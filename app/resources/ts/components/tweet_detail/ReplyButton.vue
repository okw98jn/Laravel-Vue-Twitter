<script setup lang="ts">
import { Tweet, TweetUser } from '@/types/Tweet';
import { ChatBubbleOvalLeftIcon } from '@heroicons/vue/24/outline';
import { ref } from 'vue';
import Modal from '@/components/ui/Modal.vue';
import ReplyTweetCreate from '@/components/tweet_create/ReplyTweetCreate.vue';

type Props = {
    user: TweetUser;
    tweet: Tweet;
}
const { user, tweet } = defineProps<Props>();

const isModalOpen = ref(false);

const toggleModal = (): void => {
    isModalOpen.value = !isModalOpen.value;
};

const replyTweetIncrement = () => {
    tweet.reply_count++;
}

</script>

<template>
    <div class="flex items-center hover:text-indigo-500" @click="toggleModal">
        <div class="p-1.5 rounded-full cursor-pointer transition duration-300 ease-in-out" :class="`hover:bg-indigo-100`">
            <ChatBubbleOvalLeftIcon class="h-5 w-5" />
        </div>
        <span class="text-xs -ml-1">{{ tweet.reply_count }}</span>
    </div>
    <Modal :isOpen="isModalOpen" title="" @click="toggleModal">
        <ReplyTweetCreate :reply-tweet-user="user" :reply-tweet="tweet" :toggle-modal="toggleModal"
            :replyTweetIncrement="replyTweetIncrement" :is-detail="true" />
    </Modal>
</template>