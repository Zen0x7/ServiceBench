import { defineStore } from 'pinia';
import { ref } from 'vue';
import { v4 as uuidv4 } from 'uuid';

interface basic_event {
    title: string
    body: string
    type: string
}

interface advanced_event extends basic_event {
    id: string
    visible: boolean
    created_at: Date
}

export const useNotifications = defineStore('notifications', () => {
    const events = ref<Array<advanced_event>>([])

    const push = (event: basic_event) => {
        const id = uuidv4();
        events.value.push({
            id: id,
            visible: true,
            created_at: new Date(),
            ...event,
        } as advanced_event)

        setTimeout(() => {
            const index = events.value
                .findIndex((item) => item.id === id);

            events.value[index].visible = false;
        }, 5000)
    }

    return {
        events,
        push,
    }
})
