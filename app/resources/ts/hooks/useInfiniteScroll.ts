import { Ref, onBeforeUnmount, onMounted, computed, nextTick } from 'vue';

//TODOページを縮小すると動作しない
export function useInfiniteScroll(
    target: Ref<Element | null>,
    isLastPage: ReturnType<typeof computed>,
    load: () => void,
): void {
    let observer: IntersectionObserver | null = null;

    const checkAndLoad = () => {
        if (target.value && target.value.getBoundingClientRect().bottom <= window.innerHeight && !isLastPage.value) {
            load();
        }
    };

    onMounted(() => {
        if (target.value) {
            observer = new IntersectionObserver(entries => {
                if (entries[0].isIntersecting && !isLastPage.value) {
                    load();
                }
            });

            observer.observe(target.value);
        }

        nextTick(checkAndLoad);
    });

    onBeforeUnmount(() => {
        observer?.disconnect();
    });
}