import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import { useLocalStorage } from '@vueuse/core';
import {subscribe, unsubscribe} from "@/services/broadcasting.ts";

interface user {
    id: number
    name: string
    email: string
    email_verified_at: string|null
    created_at: string|null
    updated_at: string|null
}

export const useAuthentication = defineStore('authentication', () => {
    const auth = ref(useLocalStorage("auth", {
        user: {
            id: '',
            name: '',
            email: '',
            email_verified_at: '',
            created_at: '',
            updated_at: '',
        } as user,
        bearer: '' as string,
    }))

    const users = ref([]);

    const connected_users = ref([]);

    const teams = ref([
        { id: 1, name: 'Infrastructure', href: '#', initial: 'I', current: false },
        { id: 2, name: 'Engineering', href: '#', initial: 'E', current: false },
        { id: 3, name: 'UI', href: '#', initial: 'U', current: false },
    ])

    const is_authenticated = computed(() => auth.value.bearer != '')

    const has_profile = computed(() => auth.value.user.id != '')

    const is_connected = (user) => {
        return connected_users.value.some((item) => item.id === user.id)
    }

    const set_token = async (token: string) => {
        auth.value.bearer = token;
        window.axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
        try {
            const response = await window.axios.get("/api/user")
            auth.value.user = response.data;
            subscribe(auth.value.user.id);
        } catch (e) {
            console.log(e)
        }
    }

    const get_users = async () => {
        try {
            const response = await window.axios.get("/api/users")

            users.value = response.data;
        } catch (e) {

        }
    }

    const revoke = async () => {
        try {
            unsubscribe(auth.value.user.id)

            await window.axios.post("/api/auth/revoke", {},{
                headers: {
                    Accept: "application/json",
                }
            })

            delete window.axios.defaults.headers.common["Authorization"];

        } catch (e) {
            console.log(e)
        }

        auth.value = {
            user: {
                id: '',
                name: '',
                email: '',
                email_verified_at: '',
                created_at: '',
                updated_at: '',
            } as user,
            bearer: '' as string,
        }
    }


    return {
        auth,
        users,
        connected_users,
        teams,
        is_authenticated,
        has_profile,
        is_connected,
        get_users,
        set_token,
        revoke,
    }
})
