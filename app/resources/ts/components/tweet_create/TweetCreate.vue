<script setup lang="ts">
import { AuthStore } from '@/types/Auth';
import { CameraIcon, XMarkIcon } from "@heroicons/vue/24/outline"
import Button from '@/components/ui/Button.vue';
import UserIcon from "@/components/tweet_create/UserIcon.vue";
import { computed, ref } from 'vue';

type Props = {
    user: AuthStore;
}

const { user } = defineProps<Props>();

const tweet = ref({
    text: '',
    image: '',
});

const isLoading = ref(false);

const canTweetButton = computed(() => {
    return tweet.value.text.length > 0;
});

const formData = new FormData();

// const storeTweet = () => {
//     isLoading.value = true;

//     formData.append('text', tweet.value.text);

//     profileStore.updateProfile(userId, formData)
//         .then(() => {
//             toggleModal();
//         })
//         .catch((err) => {
//             errorMessages.value = err
//         })
//         .finally(() => {
//             isLoading.value = false;
//         });
// };

const fileInputTweetImage = ref();

const selectTweetImage = () => {
    fileInputTweetImage.value.click();
};

const removeTweetImage = () => {
    tweet.value.image = '';
    formData.delete('image');
};

const handleImageSelect = (event: Event) => {
    const file = (event.target as HTMLInputElement).files?.[0];
    if (file) {
        formData.append('image', file);
        const reader = new FileReader();
        reader.onload = (e) => {
            tweet.value.image = (e.target as FileReader).result as string;
        };
        reader.readAsDataURL(file);
    }
};

</script>

<template>
    <div class="flex items-start justify-between mb-4">
        <UserIcon :userIcon="user.data.icon_image" />
        <textarea v-model="tweet.text" class="resize-none focus:outline-none w-11/12" rows="3"
            placeholder="ツイート内容"></textarea>
    </div>
    <div class="grid grid-cols-2 gap-2 mb-4">
        <div class="relative">
            <img v-if="tweet.image" :src="tweet.image" class="h-auto object-cover rounded-lg" />
            <XMarkIcon @click="removeTweetImage"
                class="absolute top-1 right-1 w-8 h-8 p-1 text-white bg-black cursor-pointer transition duration-300 ease-in-out opacity-60 hover:opacity-50 rounded-full" />
        </div>
    </div>
    <div class="border-t">
        <div class="flex items-center justify-between">
            <div>
                <CameraIcon @click="selectTweetImage"
                    class="p-1.5 w-9 h-9 text-indigo-500 rounded-full hover:bg-indigo-100 transition duration-300 ease-in-out cursor-pointer" />
                <input type="file" ref="fileInputTweetImage" accept="image/*" @change="event => handleImageSelect(event)"
                    class="hidden" />
            </div>
            <div class="w-20">
                <Button text="ツイート"
                    :className="`h-10 my-3 text-white bg-indigo-500 hover:bg-indigo-600 ${!canTweetButton ? 'opacity-50 !cursor-default' : ''}`" />
            </div>
        </div>
    </div>
</template>