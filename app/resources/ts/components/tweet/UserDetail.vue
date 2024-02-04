<script setup lang="ts">
type Props = {
    name: string;
    userId: string;
    time: string;
}
const { name, userId } = defineProps<Props>();
</script>

<template>
    <div class="flex justify-between">
        <div>
            <p class="text-sm text-gray-500">
                <span class="font-semibold text-black mr-1">{{ name }}
                </span>
                {{ userId }} · {{ time }}
            </p>
        </div>
    </div>
</template>