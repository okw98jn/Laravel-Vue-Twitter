<script setup lang="ts">
type Props = {
    color: string;
    count: string;
}
const { color, count } = defineProps<Props>();

const emit = defineEmits<{
    (event: 'click'): void;
}>();
</script>

<template>
    <div :class="`flex items-center hover:text-${color}-500`" @click="emit('click')">
        <div class="p-1.5 rounded-full cursor-pointer transition duration-300 ease-in-out" :class="`hover:bg-${color}-100`">
            <slot></slot>
        </div>
        <span class="text-xs -ml-1">{{ count }}</span>
    </div>
</template>