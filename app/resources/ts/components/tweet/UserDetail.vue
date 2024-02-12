<script setup lang="ts">
type Props = {
    id: number;
    name: string;
    userId: string;
    created: string;
}
const { id, name, userId, created } = defineProps<Props>();
</script>

<template>
    <RouterLink :to="{ name: 'TweetList', params: { userId: id } }">
        <div class="flex justify-between hover:underline">
            <div>
                <p class="text-sm text-gray-500">
                    <span class="font-semibold text-black">{{ name }}
                    </span>
                    {{ userId }} · {{ created }}
                </p>
            </div>
        </div>
    </RouterLink>
</template>