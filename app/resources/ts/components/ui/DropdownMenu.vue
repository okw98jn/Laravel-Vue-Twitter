<script setup lang="ts">

type Props = {
    isOpen: boolean;
    top: string;
    left: string;
    width: string;
}

const { isOpen, top, left, width } = defineProps<Props>();

const emit = defineEmits<{
    (event: 'mouseleave'): void;
}>();

</script>

<template>
    <transition name="fade">
        <div v-if="isOpen" :class="`absolute ${top} ${left} ${width}`" @mouseleave="emit('mouseleave')">
            <div class="bg-white rounded-lg shadow border text-black font-medium">
                <slot></slot>
            </div>
        </div>
    </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.fade-enter-to,
.fade-leave-from {
    opacity: 1;
    transform: scale(1);
}
</style>