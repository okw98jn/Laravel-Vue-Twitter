<script setup lang="ts">
type Props = {
    imagePath: string;
}
const { imagePath } = defineProps<Props>();
</script>

<template>
    <img :src="imagePath" alt="tweet image" class="w-full h-auto object-cover rounded-lg" />
</template>