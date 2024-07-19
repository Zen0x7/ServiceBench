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

    const teams = ref([
        { id: 1, name: 'Infrastructure', href: '#', initial: 'I', current: false },
        { id: 2, name: 'Engineering', href: '#', initial: 'E', current: false },
        { id: 3, name: 'UI', href: '#', initial: 'U', current: false },
    ])

    const is_authenticated = computed(() => auth.value.bearer != '')

    const has_profile = computed(() => auth.value.user.id != '')

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

    const revoke = async () => {
        try {
            unsubscribe(auth.value.user.id)

            await window.axios.post("/api/auth/revoke", {},{
                headers: {
                    Accept: "application/json",
                }
            })

            delete window.axios.defaults.headers.common["Authorization"];

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

        } catch (e) {
            console.log(e)
        }
    }


    return {
        auth,
        teams,
        is_authenticated,
        has_profile,
        set_token,
        revoke,
    }
})
