<script setup lang="ts">
import userImage from '@/assets/user.png';

type Props = {
    userIcon: string | undefined;
}

const { userIcon } = defineProps<Props>();
</script>

<template>
    <h2 class="mr-4">
        <img v-if="userIcon" :src="userIcon" alt="user" class="w-11 h-11 object-cover rounded-full">
        <img v-else :src="userImage" alt="user" class="w-11 h-11 object-cover rounded-full">
    </h2>
</template>