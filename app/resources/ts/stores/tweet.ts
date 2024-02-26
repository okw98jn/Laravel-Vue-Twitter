import axiosClient from "@/axios";
import { Pagination } from "@/types/Pagination";
import { Tweet, TweetDetail, TweetList, TweetUser } from "@/types/Tweet";
import { defineStore } from "pinia"
import { ref } from "vue"

export const useTweetStore = defineStore('tweet', () => {

    const tweetList = ref<TweetList>([{
        user: {} as TweetUser,
        tweet: {} as Tweet,
    }]);

    const tweetDetail = ref<TweetDetail>({
        user: {} as TweetUser,
        tweet: {} as Tweet,
        reply_tweets: []
    });

    const pagination = ref<Pagination>({
        current_page: 0,
        next_page: 1,
        last_page: 1,
    });

    const isLoading = ref(false);

    const fetchTweets = async (url: string) => {
        isLoading.value = true;

        try {
            const { data } = await axiosClient.get(url);
            if (data) {
                tweetList.value.push(...data.data);

                pagination.value.current_page = data.meta.current_page;
                pagination.value.last_page = data.meta.last_page;
                if (data.links.next) {
                    pagination.value.next_page = new URL(data.links.next).searchParams.get("page") as unknown as number;
                }
            } else {
                tweetList.value = [];
            }
        } catch (err: any) {
            throw err.response.data;
        } finally {
            isLoading.value = false;
        }

        return tweetList.value;
    }

    const fetchTweetList = () => fetchTweets(`/tweet?page=${pagination.value.next_page}`);
    const fetchBookmarkList = () => fetchTweets(`/tweet/bookmark?page=${pagination.value.next_page}`);
    const fetchFollowingsTweetList = () => fetchTweets(`/tweet/following?page=${pagination.value.next_page}`);
    const fetchUserTweetList = (userId: string) => fetchTweets(`/tweet/${userId}?page=${pagination.value.next_page}`);
    const fetchUserLikedTweetList = (userId: string) => fetchTweets(`/tweet/liked/${userId}?page=${pagination.value.next_page}`);

    const removeTweetById = (tweetId: number) => {
        tweetList.value = tweetList.value.filter((tweet) => tweet.tweet.id !== tweetId);
    }

    const removeReplyTweetById = (tweetId: number) => {
        tweetDetail.value.reply_tweets = tweetDetail.value.reply_tweets.filter((tweet) => tweet.tweet.id !== tweetId);
    }

    const storeTweet = async (formData: FormData) => {
        const { data } = await axiosClient.post(`/tweet`, formData)
            .catch((err) => {
                throw err.response.data;
            })

        return data;
    }

    const fetchTweetDetail = async (tweetId: string) => {
        isLoading.value = true;

        try {
            const { data } = await axiosClient.get(`/tweet/detail/${tweetId}`);
            tweetDetail.value = data.data;
        } catch (err: any) {
            throw err.response.data;
        } finally {
            isLoading.value = false;
        }

        return tweetDetail.value;
    }

    const deleteTweet = async (tweetId: number) => {
        await axiosClient.delete(`/tweet/${tweetId}`)
            .then(() => {
                removeTweetById(tweetId);
                removeReplyTweetById(tweetId);
                tweetDetail.value.tweet.reply_count -= 1;
            })
            .catch((err) => {
                throw err.response.data;
            })
    }

    return {
        isLoading,
        tweetList,
        tweetDetail,
        pagination,
        fetchTweetList,
        fetchBookmarkList,
        fetchFollowingsTweetList,
        fetchUserTweetList,
        fetchUserLikedTweetList,
        storeTweet,
        fetchTweetDetail,
        deleteTweet,
        removeTweetById,
        removeReplyTweetById,
    }
})