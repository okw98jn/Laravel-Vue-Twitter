import axios from "axios";
import { globalRouter } from "@/router/globalRouter";

const axiosClient = axios.create({
    baseURL: import.meta.env.VITE_APP_API_BASE_URL,
});

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