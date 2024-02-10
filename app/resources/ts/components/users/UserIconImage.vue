<script setup lang="ts">
import userImage from '@/assets/user.png';

type Props = {
    icon_image: string | undefined;
}
const { icon_image } = defineProps<Props>();
</script>

<template>
    <span>
        <img v-if="icon_image" :src="icon_image" alt="user" class="w-11 h-11 object-cover rounded-full">
        <img v-else :src="userImage" alt="user" class="w-11 h-11 object-cover rounded-full">
    </span>
</template>