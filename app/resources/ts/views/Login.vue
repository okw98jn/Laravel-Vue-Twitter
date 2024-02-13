<script setup lang="ts">
import type { AuthLogin } from '@/types/Auth';
import Header from '@/components/auth/Header.vue';
import SubmitButton from '@/components/auth/SubmitButton.vue';
import InputItem from '@/components/auth/InputItem.vue';
import { useAuthStore } from '@/stores/auth';
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import FooterLink from '@/components/auth/FooterLink.vue';

const router = useRouter();
const authStore = useAuthStore();
const isLoading = ref(false);

const user: AuthLogin = {
	email: '',
	password: '',
};

const errorMessages = ref({
	email: '',
	password: '',
	loginFailure: '',
});

const login = (e: Event): void => {
	e.preventDefault();
	isLoading.value = true;
	authStore.login(user)
		.then(() => {
			router.push({
				name: 'AllTweet'
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
	<Header title="Sign in" />
	<form class="mt-8 space-y-4" @submit="login">
		<div>
			<InputItem name="email" label="メールアドレス" type="email" autocomplete="email" placeholder="メールアドレス"
				:errorMessage="errorMessages.email" v-model="user.email" />
			<InputItem name="password" label="パスワード" type="password" autocomplete="current-password" placeholder="パスワード"
				:errorMessage="errorMessages.password" v-model="user.password" />
		</div>
		<div>
			<p v-if="errorMessages.loginFailure" class="text-sm text-red-600 font-medium mb-3">{{
				errorMessages.loginFailure }}
			</p>
			<SubmitButton text="ログイン" :is-loading="isLoading" />
		</div>
	</form>
	<FooterLink title="アカウントが未登録ですか？" subTitle="新規登録" routeName="Register" />
</template>