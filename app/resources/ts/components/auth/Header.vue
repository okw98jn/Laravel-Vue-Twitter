<script setup lang="ts">
type Props = {
    title: 'Sign in' | 'Sign up';
}
const { title } = defineProps<Props>()
</script>

<template>
    <div class="mt-12">
        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
            alt="Workflow" />
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            {{ title }}
        </h2>
    </div>
</template>