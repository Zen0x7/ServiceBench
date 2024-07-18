import { createRouter, createWebHistory } from "vue-router";
import {useAuthentication} from "@/stores/authentication.ts";

const routes = [
    {
        name: "Login",
        path: "/auth/login",
        component: () => import("./pages/auth/Login.vue")
    },
    {
        name: "Register",
        path: "/auth/register",
        component: () => import("./pages/auth/Register.vue")
    },
    {
        name: "Revoke",
        path: "/auth/revoke",
        component: () => import("./pages/auth/Revoke.vue")
    },
    {
        name: "Verify",
        path: "/auth/verify/:token",
        component: () => import("./pages/auth/Verify.vue")
    },
    {
        name: "Dashboard",
        path: "/dashboard",
        component: () => import("./pages/auth/Dashboard.vue")
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

const guest_routes = [
    "Login",
    "Register",
]

router.beforeEach((to, from, next) => {
    const authentication = useAuthentication();
    if (guest_routes.includes(to.name) && !authentication.is_authenticated) {
        next();
    } else {
        if (!authentication.is_authenticated) {
            next({ name: 'Login' })
        } else {
            next();
        }
    }
})

export default router;
