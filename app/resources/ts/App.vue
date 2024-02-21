<script setup lang="ts">
import { RouterView, useRouter } from 'vue-router'
import { globalRouter } from '@/router/globalRouter';

const router = useRouter();
globalRouter.router = router;

</script>

<template>
    <RouterView />
</template>