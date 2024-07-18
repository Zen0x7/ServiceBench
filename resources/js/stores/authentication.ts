import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

interface user {
    id: number
    name: string
    email: string
    email_verified_at: string|null
    created_at: string|null
    updated_at: string|null
}

export const useAuthentication = defineStore('authentication', () => {
    const auth = ref({
        user: {
            id: '',
            name: '',
            email: '',
            email_verified_at: '',
            created_at: '',
            updated_at: '',
        } as user,
        bearer: '' as string,
    })

    const teams = ref([
        { id: 1, name: 'Heroicons', href: '#', initial: 'H', current: false },
        { id: 2, name: 'Tailwind Labs', href: '#', initial: 'T', current: false },
        { id: 3, name: 'Workcation', href: '#', initial: 'W', current: false },
    ])

    const is_authenticated = computed(() => auth.value.bearer != '')

    const has_profile = computed(() => auth.value.user.id != '')

    const set_token = async (token: string) => {
        auth.value.bearer = token;

        try {
            const response = await window.axios.get("/api/user", {
                headers: {
                    Authorization: `Bearer ${token}`,
                }
            })

            auth.value.user = response.data;
        } catch (e) {

        }
    }

    const revoke = async () => {
        try {
            const response = await window.axios.post("/api/auth/revoke", {},{
                headers: {
                    Accept: "application/json",
                    Authorization: `Bearer ${auth.value.bearer}`,
                }
            })

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

            console.log(response)
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
