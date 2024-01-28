<script setup lang="ts">
import { ArrowLeftIcon } from "@heroicons/vue/24/outline"

</script>

<template>
    <div class="flex items-center space-x-2 p-4">
        <RouterLink :to="{ name: 'Home' }">
            <ArrowLeftIcon class="h-6 w-6 cursor-pointer" />
        </RouterLink>
        <span class="text-sm">0 ツイート</span>
    </div>
</template>