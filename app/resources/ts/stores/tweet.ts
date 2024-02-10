import axiosClient from "@/axios";
import { TweetList } from "@/types/Tweet";
import { defineStore } from "pinia"
import { ref } from "vue"

export const useTweetStore = defineStore('tweet', () => {
    const tweetList = ref<TweetList>({
        user: {
            name: '',
            user_id: '',
            icon_image: '',
        },
        tweets: [{
            id: 0,
            user_id: 0,
            text: '',
            like_count: 0,
            is_liked_user: false,
            created: '',
        }],
    });

    const isLoading = ref(false);

    const fetchUserTweetList = async (userId: string) => {
        isLoading.value = true;

        try {
            // const { data } = await axiosClient.get(`/user/${userId}/tweets?page=2`);
            const { data } = await axiosClient.get(`/tweet/${userId}`);
            tweetList.value = data.data;
        } catch (err: any) {
            throw err.response.data;
        } finally {
            isLoading.value = false;
        }

        return tweetList.value;
    }

    const deleteTweet = async (tweetId: number) => {
        await axiosClient.delete(`/tweet/${tweetId}`)
            .catch((err) => {
                throw err.response.data;
            })
            .finally(() => {
                tweetList.value.tweets = tweetList.value.tweets.filter((tweet) => tweet.id !== tweetId);
            });
    }

    return {
        isLoading,
        tweetList,
        fetchUserTweetList,
        deleteTweet,
    }
})