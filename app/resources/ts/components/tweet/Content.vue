<script setup lang="ts">
import { formatText } from '@/utils/formatText';

type Props = {
    text: string | null;
}
const { text } = defineProps<Props>();
</script>

<template>
    <p class="overflow-auto break-all" v-html="formatText(text)"></p>
</template>