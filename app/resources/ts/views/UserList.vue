<script setup lang="ts">
import User from '@/components/users/User.vue';
import { ComputedRef, ref } from 'vue';
import { computed, onMounted } from 'vue';
import { useUserStore } from '@/stores/user';
import { User as UserType } from '@/types/User';
import SearchInput from '@/components/users/SearchInput.vue';

const userStore = useUserStore();
const userList: ComputedRef<UserType[]> = computed(() => userStore.userList);
const isLoading = ref(false);

onMounted(async () => {
    isLoading.value = true;
    await userStore.fetchUsers();
    isLoading.value = false;
});

const searchWord = ref('');

const handleSearch = () => {
    setTimeout(async () => {
        await userStore.fetchUsers(searchWord.value);
    }, 500);
};

</script>

<template>
    <SearchInput v-model="searchWord" @input="handleSearch" />
    <div v-if="isLoading" class="flex justify-center items-center h-64">
        <vue-element-loading :active="isLoading" spinner="ring" color="#6366F1" style="z-index: 1;" />
    </div>
    <div v-else class="pb-72">
        <User v-for="user in userList" :key="user.id" :user="user" />
    </div>
</template>