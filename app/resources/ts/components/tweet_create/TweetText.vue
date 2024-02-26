<script setup lang="ts">
import userImage from '@/assets/user.png';

type Props = {
    userIcon: string | undefined;
}

const { userIcon } = defineProps<Props>();

const model = defineModel<string | null>();
</script>

<template>
    <div class="flex items-start justify-between mb-4">
        <h2 class="mr-4">
            <img v-if="userIcon" :src="userIcon" alt="user" class="w-11 h-11 object-cover rounded-full">
            <img v-else :src="userImage" alt="user" class="w-11 h-11 object-cover rounded-full">
        </h2>
        <textarea v-model="model" maxlength="140" class="resize-none focus:outline-none w-11/12 text-black" rows="4"
            placeholder="ツイート内容"></textarea>
    </div>
</template>