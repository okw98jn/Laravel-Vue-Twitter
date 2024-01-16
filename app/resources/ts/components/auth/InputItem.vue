<script setup lang="ts">
type Props = {
    name: string;
    label: string;
    type: 'text' | 'email' | 'password';
    autocomplete: string;
    placeholder: string;
    errorMessage?: string;
}
const { name, type, autocomplete, placeholder, errorMessage } = defineProps<Props>();
const model = defineModel<string>()
</script>

<template>
    <div class="mb-2">
        <label :for="name" class="sr-only">{{ label }}</label>
        <input :id="name" :name="name" :type="type" :autocomplete="autocomplete" v-model="model" :class="{
            'appearance-none relative block w-full px-3 py-2 border placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:border-indigo-500 focus:z-10 sm:text-sm': true,
            'focus:border-red-500': errorMessage,
            'border-gray-300': !errorMessage,
            'border-red-500': errorMessage
        }" :placeholder="placeholder" />
        <p v-if="errorMessage" class="text-sm text-red-600 font-medium mt-1">{{ errorMessage }}</p>
    </div>
</template>