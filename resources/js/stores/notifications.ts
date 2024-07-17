import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useNotifications = defineStore('notifications', () => {
    const events = ref([])

    return {
        events,
    }
})
