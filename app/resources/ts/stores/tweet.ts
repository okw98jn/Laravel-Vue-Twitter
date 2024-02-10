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
        tweets: [],
    });

    const isLoading = ref(false);

    const fetchTweets = async (url: string) => {
        isLoading.value = true;

        try {
            const { data } = await axiosClient.get(url);
            tweetList.value = data ? data.data : tweetList.value;
        } catch (err: any) {
            throw err.response.data;
        } finally {
            isLoading.value = false;
        }

        return tweetList.value;
    }

    const fetchUserTweetList = (userId: string) => fetchTweets(`/tweet/${userId}`);
    const fetchUserLikedTweetList = (userId: string) => fetchTweets(`/tweet/liked/${userId}`);

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
        fetchUserLikedTweetList,
        deleteTweet,
    }
})