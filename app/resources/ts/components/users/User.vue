<script setup lang="ts">
import UserIconImage from '@/components/users/UserIconImage.vue';
import UserDetail from '@/components/users/UserDetail.vue';
import FollowButton from '@/components/ui/FollowButton.vue';
import { User } from '@/types/User';

type Props = {
    user: User;
}

const { user } = defineProps<Props>();
</script>

<template>
    <RouterLink :to="{ name: 'UserTweetList', params: { userId: user.id } }">
        <div class="cursor-pointer hover:bg-gray-50 transition duration-300 ease-in-out">
            <div class="px-4 py-2">
                <div class="flex items-start space-x-4">
                    <UserIconImage :icon_image="user.icon_image" />
                    <div class="flex-1">
                        <UserDetail :name="user.name" :user-id="user.user_id" :is-follower="user.is_follower"
                            :introduction="user.introduction">
                            <div @click.prevent>
                                <FollowButton v-if="!user.is_auth_user" :target-user-id="user.id" :user-id="user.user_id"
                                    :is-follow="user.is_follow" />
                            </div>
                        </UserDetail>
                    </div>
                </div>
            </div>
        </div>
    </RouterLink>
</template>