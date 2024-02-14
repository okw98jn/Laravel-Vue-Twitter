<script setup lang="ts">
import User from '@/components/users/User.vue';
import { ComputedRef, ref } from 'vue';
import { computed, onMounted } from 'vue';
import { useUserStore } from '@/stores/user';
import { User as UserType } from '@/types/User';
import SearchInput from '@/components/users/SearchInput.vue';
import { useRoute } from 'vue-router';

const userStore = useUserStore();
const userList: ComputedRef<UserType[]> = computed(() => userStore.userList);
const isLoading: ComputedRef<boolean> = computed(() => userStore.isLoading);

const route = useRoute();
const userId = ref(route.params.userId as string);

onMounted(async () => {
    await userStore.fetchFollowerUsers(userId.value);
});

const searchWord = ref('');

const handleSearch = async () => {
    await userStore.fetchFollowerUsers(userId.value, searchWord.value);
};

</script>

<template>
    <div v-if="isLoading" class="flex justify-center items-center h-64">
        <vue-element-loading :active="isLoading" spinner="ring" color="#6366F1" style="z-index: 1;" />
    </div>
    <div v-else>
        <SearchInput v-model="searchWord" @blur="handleSearch" />
        <User v-for="user in userList" :key="user.id" :user="user" />
    </div>
</template>