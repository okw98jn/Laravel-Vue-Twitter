<script setup lang="ts">
import { MapPinIcon } from "@heroicons/vue/24/outline";
import { CalendarIcon } from "@heroicons/vue/24/outline";

</script>

<template>
    <div class="text-left px-4">
        <div class="text-lg font-semibold">アカウント名</div>
        <div class="text-gray-500 mb-4">@4eXs334kF21094</div>
        <div class="mb-2">Webエンジニア</div>
        <div class="text-gray-500 text-sm my-3 flex items-center">
            <p class="mr-4 flex items-center">
                <span>
                    <MapPinIcon class="w-5 h-5 mr-1" />
                </span>
                <span>
                    japan
                </span>
            </p>
            <p class="flex items-center">
                <span>
                    <CalendarIcon class="w-5 h-5 mr-1" />
                </span>
                <span>
                    Joined April 2023
                </span>
            </p>
        </div>
        <div class="flex items-center">
            <RouterLink :to="{ name: 'Home' }" class="mr-3">
                <p class="text-sm border-b border-transparent hover:border-current">
                    <span class="font-medium">10</span>
                    <span class="text-gray-500">フォロー</span>
                </p>
            </RouterLink>
            <RouterLink :to="{ name: 'Home' }">
                <p class="text-sm border-b border-transparent hover:border-current">
                    <span class="font-medium">10</span>
                    <span class="text-gray-500">フォロワー</span>
                </p>
            </RouterLink>
        </div>
    </div>
</template>