<script setup lang="ts">
import { HeartIcon, ChatBubbleOvalLeftIcon, EllipsisHorizontalIcon, ArrowPathRoundedSquareIcon } from "@heroicons/vue/24/outline";
import UserIconImage from '@/components/tweet/UserIconImage.vue';
import UserDetail from '@/components/tweet/UserDetail.vue';
import IconButton from "@/components/tweet/IconButton.vue";
import Content from "@/components/tweet/Content.vue";
</script>

<template>
    <div class="border-b cursor-pointer hover:bg-gray-50 transition duration-300 ease-in-out">
        <div class="p-4">
            <div class="flex items-start space-x-4">
                <UserIconImage />
                <div class="flex-1">
                    <div class="flex justify-between">
                        <UserDetail name="大川心" user-id="@okawa12334" time="6h" />
                        <EllipsisHorizontalIcon class="h-7 w-7 text-gray-500" />
                    </div>
                    <Content text="PCのメモリは何GB以上であるべきか話、とにかく頭の悪い方のエンジニアファーストみたいな連中が確実に湧いて不愉快なのであんま好きじゃない" />
                    <div class="flex items-center space-x-6 text-gray-500 mt-2">
                        <IconButton color="indigo" count="11">
                            <ChatBubbleOvalLeftIcon class="h-5 w-5" />
                        </IconButton>
                        <IconButton color="green" count="11">
                            <ArrowPathRoundedSquareIcon class="h-5 w-5" />
                        </IconButton>
                        <IconButton color="red" count="11">
                            <HeartIcon class="h-5 w-5" />
                        </IconButton>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>