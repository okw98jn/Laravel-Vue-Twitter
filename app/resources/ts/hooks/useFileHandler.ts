import { TweetForm } from '@/types/Tweet';
import { ref } from 'vue';

export function useFileHandler() {
    const tweet = ref<TweetForm>({
        text: '',
        images: [] as string[],
        videos: [] as string[],
    });

    const formData = new FormData();

    const handleFileSelect = (event: Event) => {
        const file = (event.target as HTMLInputElement).files?.[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                if (file.type.startsWith('image/')) {
                    const lastIndex = tweet.value.images.length;
                    formData.append(`images[${lastIndex}]`, file);
                    tweet.value.images.push((e.target as FileReader).result as string);
                } else if (file.type.startsWith('video/')) {
                    const lastIndex = tweet.value.videos.length;
                    formData.append(`videos[${lastIndex}]`, file);
                    const videoUrl = URL.createObjectURL(file);
                    tweet.value.videos.push(videoUrl);
                }
            };
            reader.readAsDataURL(file);
        }
    };

    const removeTweetFile = (index: number, type: 'images' | 'videos') => {
        tweet.value[type].splice(index, 1);
        formData.delete(`${type}[${index}]`);
    };

    return { tweet, formData, handleFileSelect, removeTweetFile };
}