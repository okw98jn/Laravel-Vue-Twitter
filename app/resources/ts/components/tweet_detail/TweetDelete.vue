<script setup lang="ts">
import { TrashIcon } from "@heroicons/vue/24/outline";
import { ref } from "vue";
import ModalAlert from "@/components/ui/ModalAlert.vue";
import Button from "@/components/ui/Button.vue";
import { useTweetStore } from "@/stores/tweet";
import { useAuthStore } from "@/stores/auth";
import { useRouter } from "vue-router";

type Props = {
    tweetId: number;
}

const { tweetId } = defineProps<Props>();

const tweetStore = useTweetStore();
const authStore = useAuthStore();
const router = useRouter();

const isOpen = ref(false);
const isLoading = ref(false);

const toggleModal = (): void => {
    isOpen.value = !isOpen.value;
};

const handleDelete = async () => {
    isLoading.value = true;
    tweetStore.deleteTweet(tweetId)
        .then(() => {
            toggleModal();
            router.push({
                name: 'UserTweetList',
                params: { userId: authStore.user.data.id }
            });
        })
        .catch((err) => {
            console.log(err);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

</script>

<template>
    <div class="p-1.5 rounded-full cursor-pointer transition duration-300 ease-in-out hover:bg-gray-200"
        @click="toggleModal">
        <TrashIcon class="h-5 w-5 text-gray-500" />
    </div>
    <ModalAlert :isOpen="isOpen" title="このツイートを削除しますか？" @click="toggleModal">
        <div class="mb-6">
            <p class="text-gray-500 text-sm">元に戻すことができず、あなたのプロフィール、あなたをフォローしているアカウントのタイムライン、検索結果から削除されます</p>
        </div>
        <div>
            <Button text="削除" @click="handleDelete" :isLoading="isLoading"
                className="text-white text-center bg-red-500 hover:bg-red-600 h-12 font-semibold" />
            <Button text="キャンセル" @click="toggleModal"
                className="text-black border bg-white hover:bg-gray-200 h-12 font-semibold" />
        </div>
    </ModalAlert>
</template>