export default {
    namespaced: true,
    state: {
        item: {},
        items: [],
    },
    mutations: {
        SET_ITEM(state, id) {
            state.item = state.items.find((item) => item.id === id)
        },
        SET_ITEMS(state, payload) {
            state.items = payload
        },
        RESET_ITEM(state) {
            state.item = {}
        }
    },
    actions: {
        async loadItems({commit}, query) {
            query = "?" + new URLSearchParams(query).toString()
            let uri = '/api/admin/settings/users' + query

            this.dispatch('shared/setLoading', true)

            try {
                let resp = await axios.get(uri)

                commit('SET_ITEMS', resp.data.data)

                this.dispatch('shared/setMeta', resp.data.meta)
                this.dispatch('shared/setLoading', false)

            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
            }
        },
        async loadItem({commit}, id) {
            commit('SET_ITEM', id)
        },
        async createItem({commit, state}) {
            this.dispatch('shared/setLoading', true)
            try {
                let resp = await axios.post('/api/admin/settings/users', state.item)

                this.dispatch('shared/setSuccess', resp.data)
                this.dispatch('shared/setLoading', false)
            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
                throw err
            }
        },
        async updateItem({commit, state}) {
            this.dispatch('shared/setLoading', true)

            try {
                let resp = await axios.patch('/api/admin/settings/users/' + state.item.id, state.item)
                this.dispatch('shared/setSuccess', resp.data)
                this.dispatch('shared/setLoading', false)
            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
                throw err
            }
        },
        async deleteItem({commit, state}) {
            this.dispatch('shared/setLoading', true)

            try {
                let resp = await axios.delete('/api/admin/settings/users/' + state.item.id)

                this.dispatch('shared/setSuccess', resp.data)
                this.dispatch('shared/setLoading', false)
            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
                throw err
            }
        },
        async restoreItem({commit, state}) {
            this.dispatch('shared/setLoading', true)

            try {
                let resp = await axios.post('/api/admin/settings/users/restore', state.item)

                this.dispatch('shared/setSuccess', resp.data)
                this.dispatch('shared/setLoading', false)
            } catch (err) {
                this.dispatch('shared/setError', err.response.data)
                this.dispatch('shared/setLoading', false)
                throw err
            }
        },
        async loadBlankItem({commit}) {
            commit('RESET_ITEM')
        }
    },
    getters: {
        items(state) {
            return state.items
        },
        item (state) {
            return state.item
        }
    },
}
