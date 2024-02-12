import { useAuthStore } from '@/stores/auth';
import { createRouter, createWebHistory } from 'vue-router'
import AuthLayout from '@/components/auth/AuthLayout.vue';
import DefaultLayout from '@/components/home/DefaultLayout.vue';
import Home from '@/views/Home.vue';
import Login from '@/views/Login.vue';
import Register from '@/views/Register.vue';
import Profile from '@/views/Profile.vue';
import LikeList from '@/components/profile/LikeList.vue';
import TweetList from '@/components/profile/TweetList.vue';
import Users from '@/views/Users.vue';
import UserList from '@/components/users/UserList.vue';
import FollowList from '@/components/users/FollowList.vue';
import FollowerList from '@/components/users/FollowerList.vue';
import FollowTweetList from '@/components/home/FollowTweetList.vue';
import AllTweetList from '@/components/home/AllTweetList.vue';

const routes = [
	{
		path: '/',
		redirect: '/home',
		component: DefaultLayout,
		meta: { requiresAuth: true },
		children: [
			{
				path: '/home', name: 'Home', component: Home, children: [
					{ path: '', name: 'AllTweet', component: AllTweetList },
					{ path: 'follow', name: 'FollowTweet', component: FollowTweetList },
				]
			},
			{
				path: '/profile/:userId', name: 'Profile', component: Profile, children: [
					{ path: '', name: 'TweetList', component: TweetList },
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
