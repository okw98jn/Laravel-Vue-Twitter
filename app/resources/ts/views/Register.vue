<script setup lang="ts">
import { useAuthStore } from '@/stores/auth';
import { useRouter } from 'vue-router';
import type { AuthRegister } from '@/types/Auth';
import Header from '@/components/auth/Header.vue';
import SubmitButton from '@/components/auth/SubmitButton.vue';
import InputItem from '@/components/auth/InputItem.vue';
import { ref } from 'vue';
import FooterLink from '@/components/auth/FooterLink.vue';

const authStore = useAuthStore();
const router = useRouter();
const isLoading = ref(false);

const user: AuthRegister = {
	name: '',
	user_id: '',
	email: '',
	password: '',
	password_confirmation: '',
};

const errorMessages = ref({
	name: '',
	user_id: '',
	email: '',
	password: '',
});

const register = (e: Event): void => {
	e.preventDefault();
	isLoading.value = true;
	authStore.register(user)
		.then(() => {
			router.push({
				name: 'TimeLine'
			});
		})
		.catch((err) => {
			errorMessages.value = err
		})
		.finally(() => {
			isLoading.value = false;
		});
}
</script>

<template>
	<Header title="Sign up" />
	<form class="mt-8 space-y-4" @submit="register">
		<input type="hidden" name="remember" value="true" />
		<div>
			<InputItem name="name" label="名前" type="text" autocomplete="name" placeholder="名前"
				:errorMessage="errorMessages.name" v-model="user.name" />
			<InputItem name="user_id" label="ユーザーID" type="text" autocomplete="user_id" placeholder="ユーザーID"
				:errorMessage="errorMessages.user_id" v-model="user.user_id" />
			<InputItem name="email" label="メールアドレス" type="email" autocomplete="email" placeholder="メールアドレス"
				:errorMessage="errorMessages.email" v-model="user.email" />
			<InputItem name="password" label="パスワード" type="password" autocomplete="current-password" placeholder="パスワード"
				:errorMessage="errorMessages.password" v-model="user.password" />
			<InputItem name="password_confirmation" label="パスワード確認" type="password"
				autocomplete="current-password_confirmation" placeholder="パスワード確認" v-model="user.password_confirmation" />
		</div>
		<div>
			<SubmitButton text="新規登録" :is-loading="isLoading" />
		</div>
	</form>
	<FooterLink title="アカウントをお持ちですか？ " subTitle="ログイン" routeName="Login" />
</template>