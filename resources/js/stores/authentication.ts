import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useAuthentication = defineStore('authentication', () => {
    const auth = ref({
        user: {
            name: '',
            email: '',
            email_verified_at: '',
        },
        bearer: '',
    })

    return {
        auth,
    }
})
