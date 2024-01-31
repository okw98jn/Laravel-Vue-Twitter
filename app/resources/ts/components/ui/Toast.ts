import { toast, type ToastOptions } from 'vue3-toastify';

type ToastType = 'success' | 'error' | 'info' | 'warning';

const toastOption = {
    autoClose: 2000,
    position: toast.POSITION.TOP_RIGHT,
    toastStyle: {
        fontSize: '12px',
        minHeight: '45px',
    },
} as ToastOptions;

const notify = (message: string, type: ToastType) => {
    switch (type) {
        case 'success':
            return toast.success(message, toastOption);
        case 'error':
            return toast.error(message, toastOption);
        case 'info':
            return toast.info(message, toastOption);
        case 'warning':
            return toast.warning(message, toastOption);
    }
}

export default notify;