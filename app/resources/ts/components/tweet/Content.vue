<script setup lang="ts">
type Props = {
    text: string;
}
const { text } = defineProps<Props>();
</script>

<template>
    <p>{{ text }}</p>
</template>