<script setup lang="ts">
import { Tweet } from "@/types/Tweet";
import Image from '@/components/tweet/Image.vue';
import Video from '@/components/tweet/Video.vue';

type Props = {
    tweet: Tweet;
}

const { tweet } = defineProps<Props>();

</script>

<template>
    <div class="mt-2 grid grid-cols-2 gap-0.5">
        <Image v-for="image in tweet.images" :key="image.id" :image-path="image.path" />
        <Video v-for="video in tweet.videos" :key="video.id" :id="video.id" :video-path="video.path" />
    </div>
</template>