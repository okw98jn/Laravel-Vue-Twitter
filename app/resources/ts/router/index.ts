import { useAuthStore } from '@/stores/auth';
import { createRouter, createWebHistory } from 'vue-router'
import AuthLayout from '@/components/auth/AuthLayout.vue';
import DefaultLayout from '@/components/home/DefaultLayout.vue';
import Home from '@/views/Home.vue';
import Login from '@/views/Login.vue';
import Register from '@/views/Register.vue';
import Profile from '@/views/Profile.vue';
import LikeList from '@/views/LikeList.vue';
import UserTweetList from '@/views/UserTweetList.vue';
import Users from '@/views/Users.vue';
import UserList from '@/views/UserList.vue';
import FollowList from '@/views/FollowList.vue';
import FollowerList from '@/views/FollowerList.vue';
import FollowTweetList from '@/views/FollowTweetList.vue';
import TimeLine from '@/views/TimeLine.vue';

const routes = [
	{
		path: '/',
		redirect: '/home',
		component: DefaultLayout,
		meta: { requiresAuth: true },
		children: [
			{
				path: '/home', name: 'Home', component: Home, children: [
					{ path: '', name: 'TimeLine', component: TimeLine },
					{ path: 'follow', name: 'FollowTweet', component: FollowTweetList },
				]
			},
			{
				path: '/profile/:userId', name: 'Profile', component: Profile, children: [
					{ path: '', name: 'UserTweetList', component: UserTweetList },
					{ path: 'like', name: 'LikeList', component: LikeList },
				]
			},
			{
				path: '/:userId', name: 'Users', component: Users, children: [
					{ path: 'users', name: 'UserList', component: UserList },
					{ path: 'following', name: 'FollowList', component: FollowList },
					{ path: 'followers', name: 'FollowerList', component: FollowerList },
				]
			}
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
	const authStore = useAuthStore();

	if (to.meta.requiresAuth && authStore.user.isLogin === null) {
		next({ name: 'Login' })
	} else if (authStore.user.isLogin && (to.meta.isGuest)) {
		next({ name: 'Home' })
	} else {
		next()
	}
})

export default router
