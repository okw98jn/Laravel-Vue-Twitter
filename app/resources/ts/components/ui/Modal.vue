<script setup lang="ts">
import { ref } from 'vue';
import { XMarkIcon } from "@heroicons/vue/24/outline";

type Props = {
    isOpen: boolean;
}
const { isOpen } = defineProps<Props>();

const emit = defineEmits<{
    (event: 'click'): void;
}>();

</script>

<template>
    <transition>
        <div v-if="isOpen" class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" @click="emit('click')"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full p-4">
                    <div class="flex items-center mb-4">
                        <XMarkIcon
                            class="w-8 h-8 p-1 mr-6 cursor-pointer transition duration-300 ease-in-out hover:bg-gray-200 rounded-full"
                            @click="emit('click')" />
                        <h2 class="text-lg font-semibold">プロフィール編集</h2>
                    </div>
                    <slot></slot>
                </div>
            </div>
        </div>
    </transition>
</template>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.1s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>