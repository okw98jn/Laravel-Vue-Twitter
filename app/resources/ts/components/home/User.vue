<script setup lang="ts">
import UserIconImage from '@/components/users/UserIconImage.vue';
import UserDetail from '@/components/users/UserDetail.vue';
import { EllipsisHorizontalIcon, UserMinusIcon } from "@heroicons/vue/24/outline";
import { AuthStore } from '@/types/Auth';
import { onMounted, onUnmounted, ref } from 'vue';
import DropdownMenu from '@/components/ui/DropdownMenu.vue';
import { useAuthStore } from '@/stores/auth';
import { useRouter } from 'vue-router';

type Props = {
    user: AuthStore;
}

const { user } = defineProps<Props>();

const authStore = useAuthStore();
const router = useRouter();

const logout = (): void => {
    authStore.logout()
        .then(() => {
            router.push({ name: 'Login' });
        })
};

const isOpen = ref(false);

const toggleDropdown = (event: MouseEvent) => {
    event.stopPropagation();
    isOpen.value = !isOpen.value;
}

const closeDropdown = (event: MouseEvent) => {
    const dropdownElement = document.querySelector('.dropdown');

    if (dropdownElement && !dropdownElement.contains(event.target as HTMLElement)) {
        isOpen.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', closeDropdown);
});

onUnmounted(() => {
    document.removeEventListener('click', closeDropdown);
});

</script>

<template>
    <div class="relative">
        <div @click="toggleDropdown"
            class="w-full mb-4 cursor-pointer px-4 py-2 transition duration-300 ease-in-out hover:bg-gray-200 rounded-full">
            <div class="flex items-center">
                <div class="mr-2">
                    <UserIconImage :icon_image="user.data.icon_image" />
                </div>
                <div class="flex-1">
                    <UserDetail :name="user.data.name" :user-id="user.data.user_id">
                        <EllipsisHorizontalIcon class="w-6 h-6" />
                    </UserDetail>
                </div>
            </div>
        </div>
        <DropdownMenu :is-open="isOpen" top="-top-16" left="left-0" width="w-full" class="dropdown">
            <div @click="logout" class="hover:bg-gray-100 px-4 py-3 rounded-t-lg cursor-pointer">
                <div class="flex items-center">
                    <UserMinusIcon class="h-5 w-5 mr-2" />
                    <p>ログアウト</p>
                </div>
            </div>
        </DropdownMenu>
    </div>
</template>