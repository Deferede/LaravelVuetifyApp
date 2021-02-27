export default {
    namespaced: true,
    state: {
        user: {},
        users: [],
    },
    mutations: {
        SET_USER(state, payload) {
            state.user = payload
        },
        SET_USERS(state, payload) {
            state.users = payload
        },
    },
    actions: {
        async loadUsers({commit}, query) {
            query = "?" + new URLSearchParams(query).toString()
            let uri = '/api/settings/users' + query

            this.dispatch('shared/setLoading', true)

            try {
                let resp = await axios.get(uri)

                commit('SET_USERS', resp.data.data)
                if (resp.data.meta) {
                    this.dispatch('shared/setMeta', resp.data.meta)
                }

                this.dispatch('shared/setLoading', false)

            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
            }
        },
        async loadUserById({commit}, {id, query}) {

            query = "?" + new URLSearchParams(query).toString()

            let uri = '/api/settings/users/' + id + query
            this.dispatch('shared/setLoading', true)

            try {
                let resp = await axios.get(uri)
                commit('SET_USER', resp.data.data)
                this.dispatch('shared/setLoading', false)

                return resp.data.data
            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)

                throw err
            }
        },
        async createUser({commit, state}) {
            this.dispatch('shared/setLoading', true)
            try {
                let resp = await axios.post('/api/settings/users', state.user)

                this.dispatch('shared/setSuccess', resp.data)
                this.dispatch('shared/setLoading', false)
            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
                throw err
            }
        },
        async updateUser({commit, state}) {
            this.dispatch('shared/setLoading', true)

            try {
                let resp = await axios.patch('/api/settings/users/' + state.user.id, state.user)
                this.dispatch('shared/setSuccess', resp.data)
                this.dispatch('shared/setLoading', false)
            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
                throw err
            }
        },
        async deleteUser({commit}, {id}) {
            this.dispatch('shared/setLoading', true)

            try {
                let resp = await axios.delete('/api/settings/users/' + id)

                this.dispatch('shared/setSuccess', resp.data)
                this.dispatch('shared/setLoading', false)
            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
                throw err
            }
        },
        async restoreUser({commit}, payload) {
            this.dispatch('shared/setLoading', true)

            try {
                let resp = await axios.post('/api/settings/users/restore', payload)

                this.dispatch('shared/setSuccess', resp.data)
                this.dispatch('shared/setLoading', false)
            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
                throw err
            }
        },
        async resetUser({commit}) {
            commit('SET_USER', {})
        }
    },
    getters: {
        getUsers(state) {
            return state.users
        },
        getUser (state) {
            return state.user
        }
    },
}
