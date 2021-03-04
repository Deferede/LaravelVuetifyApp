const state = {
    item: {},
    items: [],
}

const mutations = {
    SET_ITEM(state, id) {
        state.item = state.items.find((item) => item.id === id)
    },
    SET_ITEMS(state, payload) {
        state.items = payload
    },
    RESET_ITEM(state) {
        state.item = {}
    }
}

const actions = {
    async loadItems({commit}, query = {}) {
        commit('shared/SET_LOADING', true, {root: true})
        query = "?" + new URLSearchParams(query).toString()

        try {
            let resp = await axios.get('/api/admin/status/categories' + query)
            this.dispatch('shared/setMeta', resp.data.meta)

            commit('shared/SET_LOADING', false, {root: true})
            commit('SET_ITEMS', resp.data.data)

        } catch (err) {
            commit('shared/SET_ERROR', err.response.data, {root: true})
            commit('shared/SET_LOADING', false, {root: true})
        }
    },
    async loadItem({commit}, id) {
       commit('SET_ITEM', id)
    },
    async loadBlankItem({commit}) {
        commit('RESET_ITEM')
    },
    async createItem({commit, state}) {
        commit('shared/SET_LOADING', true, {root: true})

        try {
            let resp = await axios.post('/api/admin/status/categories', state.item)
            if (resp.data.meta) {
                this.dispatch('shared/setMeta', resp.data.meta)
            } else {
                this.dispatch('shared/setMeta')
            }

            commit('shared/SET_SUCCESS', resp.data, {root: true})
            commit('shared/SET_LOADING', false, {root: true})
        } catch (err) {
            commit('shared/SET_ERROR', err.response.data, {root: true})
            commit('shared/SET_LOADING', false, {root: true})
            throw err
        }
    },
    async updateItem({commit, state}) {
        commit('shared/SET_LOADING', true, {root: true})

        try {
            let resp = await axios.put('/api/admin/status/categories/' + state.item.id, state.item)

            commit('shared/SET_SUCCESS', resp.data, {root: true})
            commit('shared/SET_LOADING', false, {root: true})
        } catch (err) {
            commit('shared/SET_ERROR', err.response.data, {root: true})
            commit('shared/SET_LOADING', false, {root: true})
            throw err
        }
    },
    async deleteItem({commit, state}) {
        commit('shared/SET_LOADING', true, {root: true})

        try {
            let resp = await axios.delete('/api/admin/status/categories/' + state.item.id)

            commit('shared/SET_SUCCESS', resp.data, {root: true})
            commit('shared/SET_LOADING', false, {root: true})
        } catch (err) {
            commit('shared/SET_ERROR', err.response.data, {root: true})
            commit('shared/SET_LOADING', false, {root: true})
            throw err
        }
    }
}

const getters = {
    getItem(state) {
        return state.item
    },
    getItems(state) {
        return state.items
    },
}

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
}
