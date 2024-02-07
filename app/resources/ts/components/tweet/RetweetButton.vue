<script setup lang="ts">
import { ArrowPathRoundedSquareIcon } from '@heroicons/vue/24/outline';


type Props = {
    count: number;
}
const { count } = defineProps<Props>();

const emit = defineEmits<{
    (event: 'click'): void;
}>();
</script>

<template>
    <div :class="`flex items-center hover:text-green-500`" @click="emit('click')">
        <div class="p-1.5 rounded-full cursor-pointer transition duration-300 ease-in-out" :class="`hover:bg-green-100`">
            <ArrowPathRoundedSquareIcon class="h-5 w-5" />
        </div>
        <span class="text-xs -ml-1">{{ count }}</span>
    </div>
</template>