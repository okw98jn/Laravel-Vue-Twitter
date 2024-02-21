import axios from "axios";
import { globalRouter } from "@/router/globalRouter";

const axiosClient = axios.create({
    //TODO envから取得するようにする
    baseURL: "http://localhost:8000/api",
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