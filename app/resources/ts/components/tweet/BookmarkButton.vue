<script setup lang="ts">
import { BookmarkIcon as BookmarkIconOutline } from '@heroicons/vue/24/outline';
import { BookmarkIcon as BookmarkIconSolid } from '@heroicons/vue/24/solid';

type Props = {
    isBookmarked: boolean;
}
const { isBookmarked } = defineProps<Props>();

const emit = defineEmits<{
    (event: 'click'): void;
}>();
</script>

<template>
    <div :class="`flex items-center hover:text-indigo-500`" @click="emit('click')">
        <div class="p-1.5 rounded-full cursor-pointer transition duration-300 ease-in-out" :class="`hover:bg-indigo-100`">
            <BookmarkIconSolid v-if="isBookmarked" class="h-5 w-5 text-indigo-500" />
            <BookmarkIconOutline v-else class="h-5 w-5" />
        </div>
    </div>
</template>
