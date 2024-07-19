import './bootstrap';
import '../css/app.css';
import router from './router.ts'
import timeago from 'vue-timeago3'

import { createApp } from 'vue';
import { createPinia } from 'pinia';

import App from "@/components/App.vue";

const pinia = createPinia();

createApp(App)
    .use(pinia)
    .use(router)
    .use(timeago)
    .mount('#app')
