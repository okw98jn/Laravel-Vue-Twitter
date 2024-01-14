<script setup lang="ts">
import type { UserLogin } from '@/types/User';
import Header from '@/components/auth/Header.vue';
import SubmitButton from '@/components/auth/SubmitButton.vue';
import InputItem from '@/components/auth/InputItem.vue';
import { useUserStore } from '@/stores/user';
import { useRouter } from 'vue-router';

const router = useRouter();
const store = useUserStore();

const user: UserLogin = {
	email: '',
	password: '',
};

const login = (e: Event): void => {
	e.preventDefault();
	store.login(user)
		.then(() => {
			router.push({
				name: 'Index'
			});
		})
}
</script>

<template>
	<Header title="Sign in" sub-title="新規登録" route-name="Register" />
	<form class="mt-8 space-y-6" @submit="login">
		<div class="rounded-md shadow-sm ">
			<InputItem name="email" label="メールアドレス" type="email" autocomplete="email" placeholder="メールアドレス"
				v-model="user.email" />
			<InputItem name="password" label="パスワード" type="password" autocomplete="current-password" placeholder="パスワード"
				v-model="user.password" />
		</div>
		<div>
			<SubmitButton text="ログイン" />
		</div>
	</form>
</template>