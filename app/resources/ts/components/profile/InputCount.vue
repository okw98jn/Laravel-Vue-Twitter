<script setup lang="ts">
import { ref } from 'vue';


type Props = {
    name: string;
    label: string;
    placeholder: string;
    maxCount: string;
    errorMessage?: string;
}
const { name, label, placeholder, maxCount, errorMessage } = defineProps<Props>();
const model = defineModel<string | null>();
const isFocused = ref(false);
</script>

<template>
    <div class="w-full mx-auto py-2">
        <div class="flex flex-col space-y-1">
            <label :for="name" class="text-sm font-medium leading-none flex justify-between">
                {{ label }}
                <span v-if="isFocused" class="text-sm font-normal">{{ model?.length }} / {{ maxCount }}</span>
                <span v-else class="text-sm font-normal text-white">none</span>
            </label>
            <input :id="name" :name="name" type="text" :maxlength="maxCount" :placeholder="placeholder" v-model="model"
                @focus="isFocused = true" @blur="isFocused = false"
                :class="{ 'border-red-500': errorMessage, 'focus:border-red-500': errorMessage, 'focus:ring-red-500': errorMessage, 'border p-2 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1': true }" />
            <p v-if="errorMessage" class="text-sm text-red-600 font-medium mt-1">{{ errorMessage }}</p>
        </div>
    </div>
</template>
