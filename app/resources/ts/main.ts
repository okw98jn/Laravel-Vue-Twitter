import { createApp } from "vue";
import App from "./App.vue";
import { createPinia } from 'pinia'
import './index.css'
import router from "./router";
import VueElementLoading from "vue-element-loading";

const app = createApp(App);

app.component("VueElementLoading", VueElementLoading);
app.use(createPinia())
app.use(router)
app.mount("#app");
