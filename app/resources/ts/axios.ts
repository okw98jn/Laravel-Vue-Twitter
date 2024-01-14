import axios from "axios";

const axiosClient = axios.create({
    //TODO envから取得するようにする
    baseURL: "http://localhost:8000/api",
});


export default axiosClient;