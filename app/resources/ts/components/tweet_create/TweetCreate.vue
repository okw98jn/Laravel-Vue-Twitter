<script setup lang="ts">
import { AuthStore } from '@/types/Auth';
import { CameraIcon, XMarkIcon } from "@heroicons/vue/24/outline"
import Button from '@/components/ui/Button.vue';
import UserIcon from "@/components/tweet_create/UserIcon.vue";
import { computed, ref } from 'vue';
import { useTweetStore } from '@/stores/tweet';
import { useProfileStore } from '@/stores/profile';

type Props = {
    user: AuthStore;
    toggleModal: () => void;
}

const { user, toggleModal } = defineProps<Props>();

const tweet = ref({
    text: '',
    images: [] as string[],
    videos: [] as string[],
});

const tweetStore = useTweetStore();
const profileStore = useProfileStore();

const isLoading = ref(false);

const canTweetButton = computed(() => {
    return tweet.value.text.length || tweet.value.images.length || tweet.value.videos.length;
});

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

const fileInputTweetFile = ref();

const selectTweetFiles = () => {
    if ((tweet.value.images.length + tweet.value.videos.length) >= 4) return;
    fileInputTweetFile.value.click();
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

const removeTweetImage = (index: number) => {
    tweet.value.images.splice(index, 1);
    formData.delete(`images[${index}]`);
};

const removeTweetVideo = (index: number) => {
    tweet.value.videos.splice(index, 1);
    formData.delete(`videos[${index}]`);
};

</script>

<template>
    <div class="flex items-start justify-between mb-4">
        <UserIcon :userIcon="user.data.icon_image" />
        <textarea v-model="tweet.text" maxlength="140" class="resize-none focus:outline-none w-11/12" rows="5"
            placeholder="ツイート内容"></textarea>
    </div>
    <div v-if="tweet.images.length || tweet.videos" class="grid grid-cols-2 gap-2 mb-4">
        <div v-for="(image, index) in tweet.images" class="relative">
            <img :src="image" class="h-auto object-cover rounded-lg" />
            <XMarkIcon @click="removeTweetImage(index)"
                class="absolute top-1 right-1 w-8 h-8 p-1 text-white bg-black cursor-pointer transition duration-300 ease-in-out opacity-60 hover:opacity-50 rounded-full" />
        </div>
        <div v-for="(video, index) in tweet.videos" class="relative">
            <video :src="video" controls class="h-auto object-cover rounded-lg" />
            <XMarkIcon @click="removeTweetVideo(index)"
                class="absolute top-1 right-1 w-8 h-8 p-1 text-white bg-black cursor-pointer transition duration-300 ease-in-out opacity-60 hover:opacity-50 rounded-full" />
        </div>
    </div>
    <div class="border-t">
        <div class="flex items-center justify-between">
            <div>
                <CameraIcon @click="selectTweetFiles"
                    class="p-1.5 w-9 h-9 text-indigo-500 rounded-full hover:bg-indigo-100 transition duration-300 ease-in-out cursor-pointer"
                    :class="tweet.images.length >= 4 ? 'hover:bg-white opacity-50 !cursor-default' : ''" />
                <input type="file" ref="fileInputTweetFile" accept="image/*,video/*"
                    @change="event => handleFileSelect(event)" class="hidden" />
            </div>
            <div class="w-20">
                <Button text="ツイート" :disabled="!canTweetButton" @click="storeTweet" :is-loading="isLoading"
                    :className="`h-10 my-3 text-white bg-indigo-500 hover:bg-indigo-600 ${!canTweetButton ? 'opacity-50 !cursor-default' : ''}`" />
            </div>
        </div>
    </div>
</template>