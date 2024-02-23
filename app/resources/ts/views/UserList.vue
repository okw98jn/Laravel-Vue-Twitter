<script setup lang="ts">
import User from '@/components/users/User.vue';
import { ComputedRef, ref } from 'vue';
import { computed } from 'vue';
import { useUserStore } from '@/stores/user';
import { User as UserType } from '@/types/User';
import SearchInput from '@/components/users/SearchInput.vue';
import { useInfiniteScroll } from '@/hooks/useInfiniteScroll';

const userStore = useUserStore();
const userList: ComputedRef<UserType[]> = computed(() => userStore.userList);
const isLoading: ComputedRef<boolean> = computed(() => userStore.isLoading);

const searchWord = ref('');

const handleSearch = async () => {
    await load()
};

const load = async () => {
    await userStore.fetchUsers(searchWord.value);
};

//無限スクロール処理
const sentinel = ref(null);
const isLastPage = computed(() => userStore.pagination.current_page === userStore.pagination.last_page);
useInfiniteScroll(sentinel, isLastPage, load);

</script>

<template>
    <SearchInput v-model="searchWord" @input="handleSearch" />
    <div class="pb-16">
        <User v-for="user in userList" :key="user.id" :user="user" />
    </div>
    <div v-if="isLoading" class="flex justify-center items-center">
        <vue-element-loading :active="isLoading" spinner="ring" color="#6366F1" style="z-index: 1;" />
    </div>
    <div ref="sentinel"></div>
</template>