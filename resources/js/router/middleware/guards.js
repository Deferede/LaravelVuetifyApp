import store from "../../store";

const guestGuard = (to, from, next) => {
    store.dispatch('user/loadCurrentUser')
        .then(() => {
            if (store.getters["user/hasRole"]('guest')) {
                next();
            }
            if (!store.getters["user/hasRole"]('guest')) {
                window.location.replace('/')
            }
        })
        .catch(() => {
            next()
        })

}

const userGuard = (to, from, next) => {
    store.dispatch('user/loadCurrentUser')
        .then(function (resp) {
            let user = resp

            if (to.name === "Home") {
                return next()
            }
            if (to.meta.middleware === undefined) {
                return next()
            }
            if (user.permissions.includes(to.meta.middleware) || user.roles.includes('admin')) {
                return next()
            } else {
                return next("/home")
            }
        })
        .catch(function (err) {
            if (err.response.status === 401) {
                return next("/login")
            }
            if (err.response.status === 403) {
                return next("/403")
            }
        })
}

export {userGuard, guestGuard}
