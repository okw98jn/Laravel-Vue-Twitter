<script setup lang="ts">
import { HomeIcon } from "@heroicons/vue/24/outline"
import { UserIcon } from "@heroicons/vue/24/outline";
import Button from '@/components/ui/Button.vue';

const navigation = [
    { name: 'Home', to: { name: 'Home' }, icon: HomeIcon },
    { name: 'Profile', to: { name: 'Profile' }, icon: UserIcon },
]

</script>

<template>
    <div class="flex justify-between items-center p-4">
        <div class="w-1/2"></div>
        <div class="w-1/2">
            <div class="mb-10">
                <RouterLink :to="{ name: 'Home' }">
                    <div class="mb-4 px-1 cursor-pointer">
                        <span class="transition hover:bg-gray-200 rounded-full px-4 py-3">✘</span>
                    </div>
                </RouterLink>
                <div v-for="item in navigation" :key="item.name"
                    class="w-full mb-4 cursor-pointer px-4 py-2 transition duration-300 ease-in-out hover:bg-gray-200 rounded-full"
                    :class="{ 'bg-gray-200': $route.name === item.to.name }">
                    <RouterLink :to="item.to">
                        <p class="text-xl flex items-center">
                            <span class="mr-4">
                                <component :is="item.icon" class="w-7" />
                            </span>
                            <span>{{ item.name }}</span>
                        </p>
                    </RouterLink>
                </div>
            </div>
            <Button text="Post" className="text-white" />
        </div>
    </div>
</template>