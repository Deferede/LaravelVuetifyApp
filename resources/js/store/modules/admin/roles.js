export default {
    namespaced: true,
    state: {
        role: {},
        roles: [],
    },
    mutations: {
        SET_ROLES(state, payload) {
            state.roles = payload
        },
        SET_ROLE(state, payload) {
            state.role = payload
        },
    },
    actions: {
        async loadAllRoles({commit}) {
            this.dispatch('shared/setLoading', true)
            try {
                let resp = await axios.get('/api/admin/settings/roles')
                this.dispatch('shared/setMeta', resp.data.meta)

                commit('SET_ROLES', resp.data.data)
                this.dispatch('shared/setLoading', false)

            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
            }
        },
        async attachPermissions({commit, state}) {
            this.dispatch('shared/setLoading', true)
            try {
                let resp = await axios.patch('/api/admin/settings/roles/' + state.role.id, state.role)
                this.dispatch('shared/setSuccess', resp.data)
            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
            }
            this.dispatch('shared/setLoading', false)
        },
        async loadRoleById({commit}, {id, query}) {
            this.dispatch('shared/setLoading', true)
            let uri = '/api/admin/settings/roles/' + id
            if (query) {
                uri += '?' + query
            }

            try {
                let resp = await axios.get(uri)

                commit('SET_ROLE', resp.data.data)
                this.dispatch('shared/setLoading', false)

            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
            }
        }
    },
    getters: {
        allRoles(state) {
            return state.roles
        },
        role(state) {
            return state.role
        },
    },
}
