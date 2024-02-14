import { createApp } from "vue";
import App from "@/App.vue";
import { createPinia } from 'pinia'
import '@/index.css'
import router from "@/router";
import VueElementLoading from "vue-element-loading";
import Vue3Toastify from "vue3-toastify";
import 'vue3-toastify/dist/index.css';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const app = createApp(App);

app.component("VueElementLoading", VueElementLoading);
app.component('VueDatePicker', VueDatePicker);
app.use(Vue3Toastify);
app.use(createPinia());
app.use(router)
app.mount("#app");
