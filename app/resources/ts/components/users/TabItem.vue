<script setup lang="ts">
type Props = {
    routeName: string;
    title: string;
}
const { routeName, title } = defineProps<Props>();
</script>

<template>
    <RouterLink :to="{ name: routeName }"
        class="flex flex-col items-center justify-center w-full cursor-pointer hover:bg-gray-200 transition duration-300 ease-in-out text-center">
        <p class="inline-flex items-center justify-center text-sm font-medium h-10 px-4 py-2">
            {{ title }}
        </p>
        <p v-if="$route.name === routeName" class="border-b h-[5px] w-16 bg-indigo-500 rounded-full"></p>
        <p v-else class="h-[5px]"></p>
    </RouterLink>
</template>