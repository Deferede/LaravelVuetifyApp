const state = {
    loading: false,
    alert: {showing: false},
    meta: {}, // pagination data
}

const mutations = {
    SET_LOADING(state, payload) {
        state.loading = payload
    },
    SET_ERROR(state, payload) {
        state.alert.showing = false
        state.alert = {...payload, status: 'error', showing: true}
    },
    SET_SUCCESS(state, payload) {
        state.alert.showing = false
        state.alert = {...payload, status: 'success', showing: true}
    },
    CLEAR_SNACKBAR(state) {
        state.alert = {showing: false}
    },
    SET_META(state, payload) {
        state.meta = payload
    }
}
const actions = {
    setLoading({commit}, payload) {
        commit('SET_LOADING', payload)
    },
    setError({commit}, payload) {
        commit('SET_ERROR', payload)
    },
    setSuccess({commit}, payload) {
        commit('SET_SUCCESS', payload)
    },
    clearSnackbar({commit}) {
        commit('CLEAR_SNACKBAR')
    },
    setMeta({commit}, payload) {
        switch (payload) {
            case undefined:
                commit('SET_META', {})
                break;
            default:
                if (payload) {
                    payload['per_page'] = Number(payload['per_page'])
                }
                commit('SET_META', payload)
            break;
        }
    }
}
const getters = {
    getLoading: state => state.loading,
    alert: state => state.alert,
    meta: state => state.meta,
}


export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
}
