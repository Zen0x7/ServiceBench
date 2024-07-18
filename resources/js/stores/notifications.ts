import { defineStore } from 'pinia';
import { ref } from 'vue';

interface basic_event {
    title: string
    body: string
    type: string
}

interface advanced_event extends basic_event {
    visible: boolean
}

export const useNotifications = defineStore('notifications', () => {
    const events = ref<Array<advanced_event>>([])

    const push = (event: basic_event) => {
        events.value.push({
            visible: true,
            ...event,
        } as advanced_event)
    }

    return {
        events,
        push,
    }
})
