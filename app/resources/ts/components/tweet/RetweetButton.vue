<script setup lang="ts">
import { ArrowPathRoundedSquareIcon as OutlineIcon } from '@heroicons/vue/24/outline';
import { ArrowPathRoundedSquareIcon as SolidIcon } from '@heroicons/vue/24/solid';

type Props = {
    count: number;
    isRetweeted: boolean;
}
const { count, isRetweeted } = defineProps<Props>();

const emit = defineEmits<{
    (event: 'click'): void;
}>();
</script>

<template>
    <div :class="`flex items-center hover:text-green-500`" @click="emit('click')">
        <div class="p-1.5 rounded-full cursor-pointer transition duration-300 ease-in-out" :class="`hover:bg-green-100`">
            <SolidIcon v-if="isRetweeted" class="h-5 w-5 text-green-500" />
            <OutlineIcon v-else class="h-5 w-5" />
        </div>
        <span class="text-xs -ml-1">{{ count }}</span>
    </div>
</template>