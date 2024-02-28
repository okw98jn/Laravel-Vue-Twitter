import axios from "axios";
import { globalRouter } from "@/router/globalRouter";
import { useAuthStore } from "./stores/auth";

const axiosClient = axios.create({
    baseURL: import.meta.env.VITE_APP_API_BASE_URL,
});

axiosClient.interceptors.request.use(config => {
    const store = useAuthStore();
    config.headers.Authorization = `Bearer ${store.user.token}`;
    return config;
})

axiosClient.interceptors.response.use(
    (response) => {
        return response
    },
    (error) => {
        if (error.response?.status === 404) {
            globalRouter.router?.push("/not_found");
        }
        return Promise.reject(error)
    }
)

export default axiosClient;