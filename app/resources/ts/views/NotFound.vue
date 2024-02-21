<script setup lang="ts">

</script>

<template>
    <div class="flex items-center justify-center w-full min-h-[80vh] px-4 text-center">
        <div class="space-y-4">
            <h1 class="text-6xl font-bold tracking-tighter">404</h1>
            <div class="max-w-[600px] mx-auto space-y-2">
                <h2 class="text-2xl font-bold tracking-tight">
                    Page not found.
                </h2>
                <p class="text-gray-500 dark:text-gray-400">
                    Sorry, we couldn't find the page you're looking for.
                </p>
            </div>
            <RouterLink :to="{ name: 'TimeLine' }">
                <p
                    class="mt-4 inline-flex items-center justify-center rounded-md border border-gray-200 bg-white shadow-sm px-8 h-10 text-sm font-medium transition-colors hover:bg-gray-100 hover:text-gray-900">
                    Go Home
                </p>
            </RouterLink>
        </div>
    </div>
</template>