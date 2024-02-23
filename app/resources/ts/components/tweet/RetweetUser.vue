<script setup lang="ts">
import { ArrowPathRoundedSquareIcon } from '@heroicons/vue/24/outline';

type Props = {
    retweetedUser: string;
}

const { retweetedUser } = defineProps<Props>();

</script>

<template>
    <div class="px-6 mb-1 flex items-center text-gray-500">
        <p class="mr-1">
            <ArrowPathRoundedSquareIcon class="w-4 h-4" />
        </p>
        <p class="text-sm font-medium">{{ retweetedUser }}がリツーイト</p>
    </div>
</template>