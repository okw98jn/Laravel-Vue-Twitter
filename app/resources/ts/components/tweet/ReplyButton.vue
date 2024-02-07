<script setup lang="ts">
import { ChatBubbleOvalLeftIcon } from '@heroicons/vue/24/outline';


type Props = {
    count: number;
}
const { count } = defineProps<Props>();

const emit = defineEmits<{
    (event: 'click'): void;
}>();
</script>

<template>
    <div :class="`flex items-center hover:text-indigo-500`" @click="emit('click')">
        <div class="p-1.5 rounded-full cursor-pointer transition duration-300 ease-in-out" :class="`hover:bg-indigo-100`">
            <ChatBubbleOvalLeftIcon class="h-5 w-5" />
        </div>
        <span class="text-xs -ml-1">{{ count }}</span>
    </div>
</template>