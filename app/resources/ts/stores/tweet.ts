import axiosClient from "@/axios";
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
            video_path: '',
            like_count: 0,
            is_liked_user: false,
            is_bookmarked: false,
            created: '',
            can_delete: false,
            images: [],
        },
    }]);

    const isLoading = ref(false);

    const fetchTweets = async (url: string) => {
        isLoading.value = true;

        try {
            const { data } = await axiosClient.get(url);
            if (data) {
                tweetList.value = data.data;
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
    const fetchTweetList = () => fetchTweets('/tweet');
    const fetchBookmarkList = () => fetchTweets('/tweet/bookmark');
    const fetchFollowingsTweetList = () => fetchTweets('/tweet/following');
    const fetchUserTweetList = (userId: string) => fetchTweets(`/tweet/${userId}`);
    const fetchUserLikedTweetList = (userId: string) => fetchTweets(`/tweet/liked/${userId}`);

    const removeTweetById = (tweetId: number) => {
        tweetList.value = tweetList.value.filter((tweet) => tweet.tweet.id !== tweetId);
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
        fetchTweetList,
        fetchBookmarkList,
        fetchFollowingsTweetList,
        fetchUserTweetList,
        fetchUserLikedTweetList,
        deleteTweet,
        removeTweetById,
    }
})