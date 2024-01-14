import AuthLayout from '@/components/auth/AuthLayout.vue';
import { useUserStore } from '@/stores/user';
import Index from '@/views/Index.vue';
import Login from '@/views/Login.vue';
import Register from '@/views/Register.vue';
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
	{
		path: '/',
		// redirect: '/dashboard',
		component: Index,
		name: 'Index',
		meta: { requiresAuth: true },
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
