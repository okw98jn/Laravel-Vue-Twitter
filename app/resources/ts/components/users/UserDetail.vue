<script setup lang="ts">
type Props = {
    name: string;
    userId: string;
    introduction: string;
}
const { name, userId, introduction } = defineProps<Props>();
</script>

<template>
    <div>
        <div class="flex justify-between items-center">
            <div class="">
                <p class="font-semibold text-black">{{ name }}
                </p>
                <p class="text-gray-500 -mt-1">
                    {{ userId }}
                </p>
            </div>
            <slot></slot>
        </div>
        <div>
            {{ introduction }}
        </div>
    </div>
</template>