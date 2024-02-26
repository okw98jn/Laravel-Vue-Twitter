<script setup lang="ts">
type Props = {
    id: number;
    name: string;
    userId: string;
}
const { id, name, userId } = defineProps<Props>();
</script>

<template>
    <RouterLink :to="{ name: 'UserTweetList', params: { userId: id } }">
        <div class="flex justify-between hover:underline">
            <div>
                <h2 class="text-sm text-gray-500">
                    <p class="font-semibold text-black">{{ name }}</p>
                    <p>{{ userId }}</p>
                </h2>
            </div>
        </div>
    </RouterLink>
</template>