<script setup lang="ts">
import userImage from '@/assets/user.png';
</script>

<template>
    <span class="flex h-10 w-10 shrink-0 overflow-hidden rounded-full">
        <span class="w-32 h-32 object-cover rounded-full">
            <img :src="userImage" alt="user" class="rounded-full">
        </span>
    </span>
</template>