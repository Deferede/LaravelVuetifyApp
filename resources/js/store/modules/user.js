import cookie from 'js-cookie'

const PASSPORT_NAME = process.env.MIX_PASSPORT_NAME
const PASSPORT_DOMAIN = process.env.MIX_PASSPORT_DOMAIN

const DEFAULT_USER = {
    username: "Guest",
    roles: ['guest'],
    permissions: []
}

const state = {
    currentUser: DEFAULT_USER,
}

const mutations = {
    SET_CURRENT_USER(state, payload) {
        if (payload) {
            state.currentUser = payload
        } else {
            state.currentUser = DEFAULT_USER
        }
    },
}

const actions = {
    async registerUser({commit}, user) {
        commit('shared/SET_LOADING', true, {root: true})

        try {
            let resp = await axios.post('/api/auth/register', user)
            commit('shared/SET_LOADING', false, {root: true})
        } catch (err) {
            commit('shared/SET_ERROR', err.response.data, {root: true})
            commit('shared/SET_LOADING', false, {root: true})
        }
    },
    async loginUser({commit}, user) {
        commit('shared/SET_LOADING', true, {root: true})

        try {
            let resp = await axios.post('/api/auth/login', user)
            console.log(resp)
            let token = resp.data.data.token
            cookie.set(PASSPORT_NAME, token, {expires: 365, domain: PASSPORT_DOMAIN})
            axios.defaults.headers.common['Authorization'] = 'bearer ' + token

            commit('shared/SET_LOADING', false, {root: true})
            this.dispatch('loadCurrentUser')
        } catch (err) {
            commit('shared/SET_ERROR', err.response.data, {root: true})
            commit('shared/SET_LOADING', false, {root: true})
            throw err
        }
    },
    async loadCurrentUser({commit, state}) {
        commit('shared/SET_LOADING', true, {root: true})
        try {
            let resp = await axios.post('/api/auth/me')
            commit('SET_CURRENT_USER', resp.data.data)
            commit('shared/SET_LOADING', false, {root: true})

            return state.currentUser

        } catch (err) {
            commit('shared/SET_ERROR', err.response.data, {root: true})
            commit('shared/SET_LOADING', false, {root: true})

            throw err
        }
    },
    async logoutUser({commit}) {
        commit('shared/SET_LOADING', true, {root: true})
        commit('SET_CURRENT_USER', DEFAULT_USER)
        cookie.remove(PASSPORT_NAME, {path: '/', domain: PASSPORT_DOMAIN})
        axios.defaults.headers.common['Authorization'] = 'bearer ' + null
        commit('shared/SET_LOADING', false, {root: true})
    },
    async getUser({commit}) {
        if (this.getters.currentUser === null) {
            await this.dispatch('loadCurrentUser')
        }
        return this.state.currentUser
    },
    async hasPermissionTo({commit}, {permissionName}) {
        commit('shared/SET_LOADING', true, {root: true})
        try {
            let resp = axios.post('/api/auth/hasPermissionTo', {permissionName: permissionName})
            commit('shared/SET_LOADING', false, {root: true})

            return resp

        } catch (err) {
            commit('shared/SET_ERROR', err.response.data, {root: true})
            commit('shared/SET_LOADING', false, {root: true})

            throw err
        }
    },

}

const getters = {
    currentUser(state) {
        return state.currentUser
    },
    hasRole: (state) => (roles) => {
        if (Array.isArray(roles)) {
            for (let role of roles) {
                if (state.currentUser.roles.includes(role)) {
                    return true
                }
            }
            return false
        }
        return state.currentUser.roles.includes(roles)
    },
    hasPermission: (state) => (permissions) => {
        if (Array.isArray(permissions)) {
            for (let permission of permissions) {
                if (state.currentUser.permissions.includes(permission)) {
                    return true
                }
            }
            return false
        }
        return state.currentUser.permissions.includes(permissions)
    },
    sideMenus() {
        return [
            {title: 'Home', icon: 'mdi-home',roles:['user', 'admin'], url: '/'},
            {title: 'Admin', icon: 'mdi-view-dashboard', roles: ['admin', 'user'], sub_menu: [
                    {title: 'Settings', icon: 'mdi-playlist-edit', roles: ['admin', 'user'], sub_sub_menu: [
                            {title: 'Users', icon: 'mdi-account-multiple', permissions: ['crm.users-list'], url: '/admin/settings/users'},
                            {title: 'Permissions', icon: 'mdi-square-edit-outline', permissions: ['crm.permissions-list'], url: '/admin/settings/permissions'},
                            {title: 'Roles', icon: 'mdi-square-edit-outline', permissions: ['crm.roles-list'], url: '/admin/settings/roles'},
                            {title: 'Statuses', icon: 'mdi-square-edit-outline', permissions: ['crm.statuses-list'], url: '/admin/settings/statuses'},
                        ]
                    },
                ]
            },
            {
                title: 'Leads', icon: 'mdi-view-dashboard', permissions: ['crm.leads-list'], sub_menu: [
                    {title: 'All leads', icon: 'mdi-view-dashboard', permissions: ['crm.leads-list'], url: '/leads/all'},
                ]
            },
            {title: 'Login', icon: 'mdi-account-arrow-left', url: '/login'},
        ]
    },
    topMenus() {
        return [
            {title: 'Me', icon: 'mdi-account', roles: ['admin', 'user'], url: '/me'},
            {title: 'Login', icon: 'mdi-account-arrow-left',roles: ['guest'], url: '/login'},
        ]
    }
}

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
}
