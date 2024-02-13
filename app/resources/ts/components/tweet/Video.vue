<script setup lang="ts">
type Props = {
    path: string;
}
const { path } = defineProps<Props>();
</script>

<template>
    <video class="w-full h-96 object-cover rounded-lg" controls :src="path"></video>
</template>