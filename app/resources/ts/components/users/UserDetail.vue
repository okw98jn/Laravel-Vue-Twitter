<script setup lang="ts">
type Props = {
    name: string;
    userId: string;
    introduction?: string | null;
    isFollower?: boolean;
}
const { name, userId, introduction, isFollower } = defineProps<Props>();
</script>

<template>
    <div>
        <div class="flex justify-between items-center">
            <div>
                <p class="font-semibold text-black">{{ name }}
                </p>
                <p class="text-gray-500 -mt-1 mb-1">
                    {{ userId }}
                </p>
                <span v-if="isFollower"
                    class="bg-gray-200 inline-block text-gray-700 px-2 py-0.5 mb-1 rounded-lg text-sm">フォローされています</span>
            </div>
            <slot></slot>
        </div>
        <div>
            {{ introduction }}
        </div>
    </div>
</template>