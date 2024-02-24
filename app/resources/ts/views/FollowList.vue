<script setup lang="ts">
import User from '@/components/users/User.vue';
import { ComputedRef, ref } from 'vue';
import { computed } from 'vue';
import { useUserStore } from '@/stores/user';
import { User as UserType } from '@/types/User';
import SearchInput from '@/components/users/SearchInput.vue';
import { useRoute } from 'vue-router';
import InfiniteLoading from "v3-infinite-loading";
import "v3-infinite-loading/lib/style.css";

const userStore = useUserStore();
const userList: ComputedRef<UserType[]> = computed(() => userStore.userList);
const isLoading: ComputedRef<boolean> = computed(() => userStore.isLoading);

const route = useRoute();
const userId = ref(route.params.userId as string);

const searchWord = ref('');

const handleSearch = async () => {
    userStore.resetPagination();
    await load()
};

const load = async () => {
    await userStore.fetchFollowUsers(userId.value, searchWord.value);
};

const infiniteLoad = ($state: any) => {
    const isLastPage = computed(() => userStore.pagination.current_page === userStore.pagination.last_page);
    if (isLastPage.value) {
        $state.complete();
        return;
    }
    load();
};

</script>

<template>
    <SearchInput v-model="searchWord" @blur="handleSearch" />
    <div class="pb-16">
        <User v-for="user in userList" :key="user.id" :user="user" />
    </div>
    <div v-if="isLoading" class="flex justify-center items-center">
        <vue-element-loading :active="isLoading" spinner="ring" color="#6366F1" style="z-index: 1;" />
    </div>
    <infinite-loading @infinite="infiniteLoad">
        <template #spinner>
            <span></span>
        </template>
        <template #complete>
            <span></span>
        </template>
    </infinite-loading>
</template>