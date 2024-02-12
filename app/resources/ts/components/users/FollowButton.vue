<script setup lang="ts">
import Button from '@/components/ui/Button.vue';
import { ref } from 'vue';
import ModalAlert from '../ui/ModalAlert.vue';

type Props = {
    isFollow: boolean;
    userId: string;
}

const { userId, isFollow: isFollowProps } = defineProps<Props>();

const isFollow = ref(isFollowProps);
const isOpen = ref(false);
const buttonText = ref('フォロー中');

const onMouseOver = () => {
    buttonText.value = 'フォロー解除';
}

const onMouseOut = () => {
    buttonText.value = 'フォロー中';
}

const handleFollow = () => {
    isFollow.value = true;
}

const handleUnFollow = () => {
    isFollow.value = false;
    toggleModal();
}

const toggleModal = (): void => {
    isOpen.value = !isOpen.value;
};

</script>

<template>
    <div>
        <Button v-if="isFollow" :text="buttonText" @click="toggleModal" @mouseover="onMouseOver" @mouseout="onMouseOut"
            class-name="!w-28 h-8 text-black border hover:bg-red-100 hover:border-red-200 hover:text-red-500 font-semibold" />
        <Button v-else text="フォロー" @click="handleFollow"
            class-name="!w-28 h-8 text-white bg-black hover:opacity-75 font-semibold" />
    </div>
    <ModalAlert :isOpen="isOpen" :title="userId + 'のフォローを解除しますか？'" @click="toggleModal">
        <div class="mb-6">
            <p class="text-gray-500 text-sm">フォローを解除するとタイムラインに表示されません。プロフィールは引き続き閲覧できます。</p>
        </div>
        <div>
            <Button text="フォロー解除" @click="handleUnFollow" :isLoading="false"
                className="text-white text-center bg-black hover:opacity-75 h-12 font-semibold" />
            <Button text="キャンセル" @click="toggleModal"
                className="text-black border bg-white hover:bg-gray-200 h-12 font-semibold" />
        </div>
    </ModalAlert>
</template>
