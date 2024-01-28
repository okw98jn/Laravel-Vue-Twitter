<script setup lang="ts">
import { XMarkIcon } from "@heroicons/vue/24/outline";

type Props = {
    isOpen: boolean;
    title: string;
}
const { isOpen, title } = defineProps<Props>();

const emit = defineEmits<{
    (event: 'click'): void;
}>();

</script>

<template>
    <transition name="modal">
        <div v-if="isOpen" class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" @click="emit('click')"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div
                    class="inner inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-1/3 p-4">
                    <div class="flex items-center mb-4">
                        <XMarkIcon
                            class="w-8 h-8 p-1 mr-6 cursor-pointer transition duration-300 ease-in-out hover:bg-gray-200 rounded-full"
                            @click="emit('click')" />
                        <h2 class="text-lg font-semibold">{{ title }}</h2>
                    </div>
                    <slot></slot>
                </div>
            </div>
        </div>
    </transition>
</template>

<style scoped>
.modal-enter-active,
.modal-leave-active {
    transition: all 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

.modal-enter-from .inner,
.modal-leave-to .inner {
    opacity: 0;
    transform: scale(0.95);
}

.modal-enter-to,
.modal-leave-from {
    opacity: 1;
    transform: scale(1);
}

.modal-enter-to .inner,
.modal-leave-from .inner {
    opacity: 1;
    transform: scale(1);
}
</style>