import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/auth/verify/:token",
        component: () => import("./pages/auth/Verify.vue")
    }
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
