<script setup lang="ts">
import { LockClosedIcon } from '@heroicons/vue/24/solid'

type Props = {
    text: string;
    isLoading: boolean;
}
const { text, isLoading } = defineProps<Props>();
</script>

<template>
    <button type="submit" :disabled="isLoading"
        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white transition duration-300 ease-in-out focus:outline-none"
        :class="isLoading ? 'bg-gray-300' : 'bg-indigo-600 hover:bg-indigo-700'">
        <template v-if="isLoading">
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </template>
        <template v-else>
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
            </span>
            {{ text }}
        </template>
    </button>
</template>