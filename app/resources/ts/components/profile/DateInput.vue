<script setup lang="ts">
type Props = {
    name: string;
    label: string;
    errorMessage?: string;
}

const { name, label, errorMessage } = defineProps<Props>();
const model = defineModel<string | null>();
</script>

<template>
    <div class="w-full mx-auto py-2">
        <div class="flex flex-col space-y-1">
            <label :for="name" class="text-sm font-medium leading-none flex justify-between mb-1">
                {{ label }}
            </label>
            <VueDatePicker class="" v-model="model" format="yyyy年MM月dd日" model-type="yyyy年MM月dd日"
                :enable-time-picker="false" auto-apply locale="ja" />
            <p v-if="errorMessage" class="text-sm text-red-600 font-medium mt-1">{{ errorMessage }}</p>
        </div>
    </div>
</template>
