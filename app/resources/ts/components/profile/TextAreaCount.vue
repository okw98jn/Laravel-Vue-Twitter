<script setup lang="ts">
import { ref } from 'vue';


type Props = {
    name: string;
    label: string;
    placeholder: string;
    maxCount: string;
}
const { name, label, placeholder, maxCount } = defineProps<Props>();
const model = defineModel<string>();
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
            <textarea :id="name" :name="name" :maxlength="maxCount" :placeholder="placeholder" v-model="model" rows="3"
                @focus="isFocused = true" @blur="isFocused = false"
                class="border p-2 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1">
            </textarea>
        </div>
    </div>
</template>
