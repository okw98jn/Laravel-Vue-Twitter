<script setup lang="ts">
import { useUserStore } from '@/stores/user';
import { useRouter } from 'vue-router';
import type { UserRegister } from '@/types/User';
import Header from '@/components/auth/Header.vue';
import SubmitButton from '@/components/auth/SubmitButton.vue';
import InputItem from '@/components/auth/InputItem.vue';
import { ref } from 'vue';
import FooterLink from '@/components/auth/FooterLink.vue';

const store = useUserStore();
const router = useRouter();

const user: UserRegister = {
	name: '',
	email: '',
	password: '',
	password_confirmation: '',
};

const errorMessages = ref({
	name: '',
	email: '',
	password: '',
});

const register = (e: Event): void => {
	e.preventDefault();
	store.register(user)
		.then(() => {
			router.push({
				name: 'Index'
			});
		})
		.catch((err) => {
			errorMessages.value = err
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
			<InputItem name="email" label="メールアドレス" type="email" autocomplete="email" placeholder="メールアドレス"
				:errorMessage="errorMessages.email" v-model="user.email" />
			<InputItem name="password" label="パスワード" type="password" autocomplete="current-password" placeholder="パスワード"
				:errorMessage="errorMessages.password" v-model="user.password" />
			<InputItem name="password_confirmation" label="パスワード確認" type="password"
				autocomplete="current-password_confirmation" placeholder="パスワード確認" v-model="user.password_confirmation" />
		</div>
		<div>
			<SubmitButton text="新規登録" />
		</div>
	</form>
	<FooterLink title="アカウントをお持ちですか？ " subTitle="ログイン" routeName="Login" />
</template>