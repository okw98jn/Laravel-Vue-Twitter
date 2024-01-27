import { useUserStore } from '@/stores/user';
import { createRouter, createWebHistory } from 'vue-router'
import AuthLayout from '@/components/auth/AuthLayout.vue';
import DefaultLayout from '@/components/home/DefaultLayout.vue';
import Home from '@/views/Home.vue';
import Login from '@/views/Login.vue';
import Register from '@/views/Register.vue';
import Profile from '@/views/Profile.vue';

const routes = [
	{
		path: '/',
		redirect: '/home',
		component: DefaultLayout,
		meta: { requiresAuth: true },
		children: [
			{ path: '/home', name: 'Home', component: Home },
			{ path: '/profile', name: 'Profile', component: Profile },
		]
	},
	{
		path: '/auth',
		redirect: '/login',
		name: 'Auth',
		component: AuthLayout,
		meta: { isGuest: true },
		children: [
			{ path: '/login', name: 'Login', component: Login },
			{ path: '/register', name: 'Register', component: Register },
		]
	},
]

const router = createRouter({
	history: createWebHistory(),
	routes,
});

router.beforeEach((to, from, next) => {
	const store = useUserStore();

	if (to.meta.requiresAuth && store.user.isLogin === null) {
		next({ name: 'Login' })
	} else if (store.user.isLogin && (to.meta.isGuest)) {
		next({ name: 'Index' })
	} else {
		next()
	}
})

export default router
