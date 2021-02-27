export default {
    namespaced: true,
    state: {
        permission: {},
        permissions: [],
    },
    mutations: {
        SET_PERMISSIONS(state, payload) {
            state.permissions = payload
        },
        SET_PERMISSION(state, payload) {
            state.permission = payload
        },
    },
    actions: {
        async loadPermissions({commit}) {
            this.dispatch('shared/setLoading', true)
            commit('SET_PERMISSIONS', [])

            try {
                let resp = await axios.get('/api/settings/permissions')

                commit('SET_PERMISSIONS', resp.data.data)
                this.dispatch('shared/setLoading', false)

            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
            }
        },
        async loadPermissionById({commit}, {id, query}) {
            this.dispatch('shared/setLoading', true)
            let uri = '/api/settings/permissions/' + id
            if (query) {
                uri += '?' + query
            }

            try {
                let resp = await axios.get(uri)

                commit('SET_PERMISSION', resp.data.data)
                this.dispatch('shared/setLoading', false)

            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
            }
        }
    },
    getters: {
        allPermissions(state) {
            return state.permissions
        },
        onePermission(state) {
            return state.permission
        }
    },
}
