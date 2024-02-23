<script setup lang="ts">
type Props = {
    text: string | null;
}
const { text } = defineProps<Props>();
</script>

<template>
    <p class="overflow-auto break-all">{{ text }}</p>
</template>