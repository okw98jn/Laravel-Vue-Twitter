<script setup lang="ts">
type Props = {
    text: string | null;
}
const { text } = defineProps<Props>();
</script>

<template>
    <p>{{ text }}</p>
</template>