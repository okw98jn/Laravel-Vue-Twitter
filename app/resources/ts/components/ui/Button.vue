<script setup lang="ts">
type Props = {
    text: string;
    className?: string;
}
const { text, className } = defineProps<Props>();

const emit = defineEmits<{
    (event: 'click'): void;
}>();

</script>

<template>
    <button
        @click="emit('click')"
        class="w-full mb-4 text-center cursor-pointer px-4 py-3 transition duration-300 ease-in-out rounded-full"
        :class="className" >
        {{ text }}
    </button>
</template>