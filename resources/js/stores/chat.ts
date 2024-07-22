import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useChat = defineStore('chat', () => {
    const on = ref("")

    const events = ref([])

    const push = (event) => {

        events.value.push({
            created_at: new Date(),
            ...event,
        })

        setTimeout(() => {
            const element = window.document.getElementById("chat-box")

            console.log(element)

            if (element) {
                element.scrollIntoView({behavior: 'smooth'});
            }
        }, 100)

    }

    const retrieve = async (id) => {
        const response = await window.axios.get(`/api/users/${id}/receive`)

        events.value = response.data.data;
    }

    const set_on = (name) => {
        on.value = name
    }

    return {
        on,
        events,
        retrieve,
        set_on,
        push,
    }
})
