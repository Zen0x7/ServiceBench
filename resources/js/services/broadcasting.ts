import {useAuthentication} from "@/stores/authentication.ts";

export const subscribe = (id) => {
    const authentication = useAuthentication();

    window.Echo.private(`App.Models.User.${id}`)
        .notification((notification) => {
            console.log(notification)
        })

    const channel = window.Echo
        .join(`App`)

    channel.here((users) => {
            authentication.connected_users = users;
        })
        .joining((user) => {
            if (!authentication.connected_users.some((item) => item.id == user.id)) {
                authentication.connected_users.push(user);
            }
        })
        .leaving((user) => {
            if (authentication.connected_users.some((item) => item.id == user.id)) {
                const index = authentication.connected_users.findIndex((item) => item.id == user.id);
                authentication.connected_users.splice(index, 1);
            }
        })
        .error((error) => {
            console.error(error);
        });
}

export const unsubscribe = (id) => {
    window.Echo.leave(`App.Models.User.${id}`)
}
