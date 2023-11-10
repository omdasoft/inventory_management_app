import './bootstrap';

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

import Routes from './routes.js';
import Login from './pages/auth/Login.vue';
const app = createApp({});

const router = createRouter({
    history: createWebHistory(),
    routes: Routes,
});

app.use(router);
app.component('Login', Login);
app.mount('#app');