import { defineStore } from "pinia"
import { ref } from "vue"

//左サイドバーのツイート作成モーダルの状態を管理するストア
//リツーイトボタンがモダールの要素より上に来るのを防ぐために、モーダルの状態をストアで管理する
export const useTweetModalStore = defineStore('tweetModal', () => {

    const isTweetModalOpen = ref(false);

    return { isTweetModalOpen }
})