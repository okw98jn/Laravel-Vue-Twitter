import axiosClient from "@/axios";
import { Pagination } from "@/types/Pagination";
import { TweetList } from "@/types/Tweet";
import { defineStore } from "pinia"
import { ref } from "vue"

export const useTweetStore = defineStore('tweet', () => {
    const tweetList = ref<TweetList>([{
        user: {
            name: '',
            user_id: '',
            icon_image: '',
        },
        tweet: {
            id: 0,
            user_id: 0,
            text: '',
            like_count: 0,
            is_liked: false,
            retweet_count: 0,
            reply_count: 0,
            is_retweeted: false,
            retweeted_user: null,
            is_bookmarked: false,
            created: '',
            can_delete: false,
            images: [],
            videos: [],
            quote_tweet: null,
        },
    }]);

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

    const storeTweet = async (formData: FormData) => {
        const { data } = await axiosClient.post(`/tweet`, formData)
            .catch((err) => {
                throw err.response.data;
            })

        return data;
    }

    const deleteTweet = async (tweetId: number) => {
        await axiosClient.delete(`/tweet/${tweetId}`)
            .then(() => {
                removeTweetById(tweetId);
            })
            .catch((err) => {
                throw err.response.data;
            })
    }

    return {
        isLoading,
        tweetList,
        pagination,
        fetchTweetList,
        fetchBookmarkList,
        fetchFollowingsTweetList,
        fetchUserTweetList,
        fetchUserLikedTweetList,
        storeTweet,
        deleteTweet,
        removeTweetById,
    }
})