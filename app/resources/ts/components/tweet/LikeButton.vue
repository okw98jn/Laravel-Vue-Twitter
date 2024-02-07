<script setup lang="ts">
import { HeartIcon as HeartIconOutline } from '@heroicons/vue/24/outline';
import { HeartIcon as HeartIconSolid } from '@heroicons/vue/24/solid';

type Props = {
    count: number;
}
const { count } = defineProps<Props>();

const emit = defineEmits<{
    (event: 'click'): void;
}>();
</script>

<template>
    <div :class="`flex items-center hover:text-red-500`" @click="emit('click')">
        <div class="p-1.5 rounded-full cursor-pointer transition duration-300 ease-in-out" :class="`hover:bg-red-100`">
            <HeartIconOutline v-if="count === 0" class="h-5 w-5" />
            <HeartIconSolid v-else class="h-5 w-5 text-rose-500" />
        </div>
        <span class="text-xs -ml-1">{{ count }}</span>
    </div>
</template>