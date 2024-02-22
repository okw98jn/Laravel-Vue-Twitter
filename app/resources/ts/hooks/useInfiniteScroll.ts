import { Ref, onBeforeUnmount, onMounted, computed } from 'vue';

export function useInfiniteScroll(
    target: Ref<Element | null>,
    isLastPage: ReturnType<typeof computed>,
    load: () => void,
): void {
    let observer: IntersectionObserver | null = null;

    onMounted(() => {
        if (target.value) {
            observer = new IntersectionObserver(entries => {
                if (entries[0].isIntersecting && !isLastPage.value) {
                    load();
                }
            });

            observer.observe(target.value);
        }
    });

    onBeforeUnmount(() => {
        observer?.disconnect();
    });
}