<script setup lang="ts">
import userImage from '@/assets/user.png';

type Props = {
    id: number;
    icon_image: string | undefined;
}
const { id, icon_image } = defineProps<Props>();
</script>

<template>
    <RouterLink :to="{ name: 'TweetList', params: { userId: id } }">
        <span class="hover:opacity-75 transition duration-300 ease-in-out">
            <img v-if="icon_image" :src="icon_image" alt="user" class="w-11 h-11 object-cover rounded-full">
            <img v-else :src="userImage" alt="user" class="w-11 h-11 object-cover rounded-full">
        </span>
    </RouterLink>
</template>