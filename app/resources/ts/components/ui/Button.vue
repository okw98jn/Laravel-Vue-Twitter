<script setup lang="ts">
type Props = {
    text: string;
    className?: string;
    isLoading?: boolean;
}
const { text, className, isLoading } = defineProps<Props>();

const emit = defineEmits<{
    (event: 'click'): void;
}>();
</script>

<template>
    <button @click="emit('click')"
        class="w-full mb-4 text-center cursor-pointer px-4 py-3 transition duration-300 ease-in-out rounded-full inline-flex items-center justify-center"
        :class="[className, isLoading ? '!bg-gray-300' : '']" :disabled="isLoading">
        <template v-if="isLoading">
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </template>
        <template v-else>
            {{ text }}
        </template>
    </button>
</template>