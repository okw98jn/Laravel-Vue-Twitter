<script setup lang="ts">

type Props = {
    icon_image: string | undefined;
}
const { icon_image } = defineProps<Props>();
</script>

<template>
    <span>
        <img :src="icon_image" alt="user" class="w-11 h-11 object-cover rounded-full">
    </span>
</template>