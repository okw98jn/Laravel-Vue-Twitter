<script setup lang="ts">
import UserIconImage from '@/components/users/UserIconImage.vue';
import UserDetail from '@/components/users/UserDetail.vue';
import FollowButton from '@/components/users/FollowButton.vue';
import { User } from '@/types/User';

type Props = {
    user: User;
}

const { user } = defineProps<Props>();
</script>

<template>
    <div class="cursor-pointer hover:bg-gray-50 transition duration-300 ease-in-out">
        <div class="px-4 py-2">
            <div class="flex items-start space-x-4">
                <UserIconImage :icon_image="user.icon_image" />
                <div class="flex-1">
                    <UserDetail :name="user.name" :user-id="user.user_id" :is-follower="user.is_follower"
                        :introduction="user.introduction">
                        <FollowButton :user-id="user.user_id" :is-follow="user.is_follow" />
                    </UserDetail>
                </div>
            </div>
        </div>
    </div>
</template>