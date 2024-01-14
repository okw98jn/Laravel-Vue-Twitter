<script setup lang="ts">
import { useUserStore } from '@/stores/user';
import { useRouter } from 'vue-router';

const store = useUserStore();
const router = useRouter();

if (store.user.data.id === null) {
	store.fetchUser();
}

const logout = (): void => {
    store.logout()
        .then(() => {
            router.push({ name: 'Login' });
        })
};

</script>

<template>
	<div>ログイン成功</div>
	<p>{{ store.user.data.email }}</p>
	<button @click="logout">ログアウト</button>
</template>