<script setup lang="ts">
type Props = {
    title: 'アカウントが未登録ですか？' | 'アカウントをお持ちですか？ ';
    subTitle: '新規登録' | 'ログイン';
    routeName: 'Login' | 'Register';
}

const { title, subTitle, routeName } = defineProps<Props>()
</script>

<template>
    <p class="mt-2 text-center text-sm text-gray-600">
        {{ title }}
        <RouterLink :to="{ name: routeName }" class="font-medium text-indigo-600 hover:text-indigo-500">
            {{ subTitle }}
        </RouterLink>
    </p>
</template>