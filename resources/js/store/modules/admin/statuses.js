import router from "../../../router";

export default {
    state: {
        status: {},
        statuses: [],
        status_types: [],
        status_categories: [],
    },
    mutations: {
        SET_ALL_STATUSES(state, payload) {
            state.statuses = payload
        },
        SET_STATUS(state, payload) {
            state.status = payload
        },
        SET_STATUS_TYPES(state, payload) {
            state.status_types = payload
        },
        SET_STATUS_CATEGORIES(state, payload) {
            state.status_categories = payload
        }
    },
    actions: {
        async loadAllStatuses({commit}) {
            commit('shared/SET_LOADING', true, {root: true})

            try {
                let resp = await axios.get('/api/statuses/status')

                commit('shared/SET_LOADING', false, {root: true})
                commit('SET_ALL_STATUSES', resp.data)

            } catch (err) {
                commit('shared/SET_ERROR', err.response.data, {root: true})
                commit('shared/SET_LOADING', false, {root: true})
            }
        },
        async loadStatusTypes({commit}) {
            commit('shared/SET_LOADING', true, {root: true})

            try {
                let resp = await axios.get('/api/statuses/type')

                commit('shared/SET_LOADING', false, {root: true})
                commit('SET_STATUS_TYPES', resp.data)

            } catch (err) {
                commit('shared/SET_ERROR', err.response.data, {root: true})
                commit('shared/SET_LOADING', false, {root: true})
            }
        },
        async loadStatusCategories({commit}) {
            commit('shared/SET_LOADING', true, {root: true})

            try {
                let resp = await axios.get('/api/statuses/category')

                commit('shared/SET_LOADING', false, {root: true})
                commit('SET_STATUS_CATEGORIES', resp.data)

            } catch (err) {
                commit('shared/SET_ERROR', err.response.data, {root: true})
                commit('shared/SET_LOADING', false, {root: true})
            }
        },
        async loadStatusById({commit}, payload) {
            commit('shared/SET_LOADING', true, {root: true})

            try {
                let resp = await axios.get('/api/statuses/status/' + payload)

                commit('shared/SET_LOADING', false, {root: true})
                commit('SET_STATUS', resp.data)

            } catch (err) {
                commit('shared/SET_ERROR', err.response.data, {root: true})
                commit('shared/SET_LOADING', false, {root: true})
            }
        },
        async loadEditingStatus({commit}, payload) {
            commit('shared/SET_LOADING', true, {root: true})

            try {
                let resp = await axios.get('/api/statuses/status/' + payload + '/edit')

                commit('shared/SET_LOADING', false, {root: true})
                commit('SET_STATUS', resp.data)

            } catch (err) {
                commit('shared/SET_ERROR', err.response.data, {root: true})
                commit('shared/SET_LOADING', false, {root: true})
            }
        },

        async loadBlankStatus({commit}) {
            commit('shared/SET_LOADING', true, {root: true})

            try {
                let resp = await axios.get('/api/statuses/status/create')

                commit('shared/SET_LOADING', false, {root: true})
                commit('SET_STATUS', resp.data)

            } catch (err) {
                commit('shared/SET_ERROR', err.response.data, {root: true})
                commit('shared/SET_LOADING', false, {root: true})
            }
        },

        async createStatus({commit}, payload) {
            commit('shared/SET_LOADING', true, {root: true})

            try {
                let resp = await axios.post('/api/statuses/status', payload)

                commit('shared/SET_SUCCESS', resp.data, {root: true})
                commit('shared/SET_LOADING', false, {root: true})
            } catch (err) {
                commit('shared/SET_ERROR', err.response.data, {root: true})
                commit('shared/SET_LOADING', false, {root: true})
                throw err
            }
        },
        async updateStatus({commit}, {id, payload}) {
            commit('shared/SET_LOADING', true, {root: true})

            try {
                let resp = await axios.put('/api/statuses/status/' + id, payload)

                commit('shared/SET_SUCCESS', resp.data, {root: true})
                commit('shared/SET_LOADING', false, {root: true})
            } catch (err) {
                commit('shared/SET_ERROR', err.response.data, {root: true})
                commit('shared/SET_LOADING', false, {root: true})
                throw err
            }
        },
        async deleteStatus({commit}, payload) {
            commit('shared/SET_LOADING', true, {root: true})

            try {
                let resp = await axios.delete('/api/statuses/status/' + payload)

                commit('shared/SET_SUCCESS', resp.data, {root: true})
                commit('shared/SET_LOADING', false, {root: true})
            } catch (err) {
                commit('shared/SET_ERROR', err.response.data, {root: true})
                commit('shared/SET_LOADING', false, {root: true})
                throw err
            }
        }
    },
    getters: {
        getStatuses(state) {
            return state.statuses
        },
        getStatusTypes(state) {
            return state.status_types
        },
        getStatusCategories(state) {
            return state.status_categories
        },
        getStatus (state) {
            return state.status
        }
    },
}
