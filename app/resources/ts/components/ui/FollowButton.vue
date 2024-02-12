<script setup lang="ts">
import Button from '@/components/ui/Button.vue';
import { ref } from 'vue';
import ModalAlert from '@/components/ui/ModalAlert.vue';
import axiosClient from '@/axios';
import { useProfileStore } from '@/stores/profile';

type Props = {
    targetUserId: number | string;
    isFollow: boolean;
    userId: string;
}

const { targetUserId, userId, isFollow: isFollowProps } = defineProps<Props>();

const profileStore = useProfileStore();

const isFollow = ref(isFollowProps);
const isOpen = ref(false);
const isLoading = ref(false);

const buttonText = ref('フォロー中');

const onMouseOver = () => {
    buttonText.value = 'フォロー解除';
}

const onMouseOut = () => {
    buttonText.value = 'フォロー中';
}

const handleFollow = async () => {
    isLoading.value = true;
    await axiosClient.post(`/user/${targetUserId}/follow`)
        .then(() => {
            isFollow.value = true;
            profileStore.profile.data.follower_count++;
        })
        .finally(() => {
            isLoading.value = false;
        })
}

const handleUnFollow = async () => {
    isLoading.value = true;
    await axiosClient.delete(`/user/${targetUserId}/un_follow`)
        .then(() => {
            isFollow.value = false;
            profileStore.profile.data.follower_count--;
            toggleModal();
        })
        .finally(() => {
            isLoading.value = false;
        })
}

const toggleModal = (): void => {
    isOpen.value = !isOpen.value;
};

</script>

<template>
    <div>
        <Button v-if="isFollow" :text="buttonText" @click="toggleModal" @mouseover="onMouseOver" @mouseout="onMouseOut"
            :is-loading="isLoading"
            class-name="!w-28 h-10 text-black border hover:bg-red-100 hover:border-red-200 hover:text-red-500 font-semibold" />
        <Button v-else text="フォロー" @click="handleFollow"
            class-name="!w-28 h-10 text-white bg-black hover:opacity-75 font-semibold" />
    </div>
    <ModalAlert :isOpen="isOpen" :title="userId + 'のフォローを解除しますか？'" @click="toggleModal">
        <div class="mb-6">
            <p class="text-gray-500 text-sm">フォローを解除するとタイムラインに表示されません。プロフィールは引き続き閲覧できます。</p>
        </div>
        <div>
            <Button text="フォロー解除" @click="handleUnFollow" :isLoading="isLoading"
                className="text-white text-center bg-black hover:opacity-75 h-12 font-semibold" />
            <Button text="キャンセル" @click="toggleModal"
                className="text-black border bg-white hover:bg-gray-200 h-12 font-semibold" />
        </div>
    </ModalAlert>
</template>
