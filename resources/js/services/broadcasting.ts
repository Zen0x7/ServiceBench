import {useAuthentication} from "@/stores/authentication.ts";

export const subscribe = (id) => {
    window.Echo.private(`App.Models.User.${id}`)
        .notification((notification) => {
            console.log(notification)
        })
}

export const unsubscribe = (id) => {
    window.Echo.leave(`App.Models.User.${id}`)
}
