<script setup lang="ts">
import { MagnifyingGlassIcon } from '@heroicons/vue/24/outline';
import { XCircleIcon } from '@heroicons/vue/24/solid';
import { ref } from 'vue';

const model = defineModel<string>();
const isFocus = ref(false);

const emit = defineEmits<{
    (event: 'blur'): void;
}>();

const handleClick = () => {
    model.value = '';
    emit('blur');
}
</script>

<template>
    <div class="flex justify-center">
        <div class="p-4 w-4/5">
            <div class="relative">
                <MagnifyingGlassIcon class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5"
                    :class="isFocus ? 'text-indigo-500' : ''" />
                <input type="text" placeholder="検索" v-model="model" @blur="emit('blur')" @focus="isFocus = true"
                    @keyup.enter="emit('blur')"
                    class="w-full border px-4 py-2 pl-10 rounded-full focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1 transition duration-300 ease-in-out" />
                <XCircleIcon v-if="!isFocus && model" @click="handleClick"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 w-7 h-7 cursor-pointer text-indigo-500 hover:opacity-75 transition duration-300 ease-in-out" />
            </div>
        </div>
    </div>
</template>