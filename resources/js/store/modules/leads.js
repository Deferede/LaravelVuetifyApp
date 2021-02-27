export default {
  state: {
    leads: [
      {
        id: 1,
        name: 'Джон Сноу',
        phone: '89996285805',
        address: 'Сервер Стена',
        status: 'reject'
      },
      {
        id: 2,
        name: 'Дейнерис Бурерождённая',
        phone: '89996288877',
        address: 'Миерин',
        status: 'in process'
      },
      {
        id: 3,
        name: 'Тирион Ланистер',
        phone: '89996288877',
        address: 'Королевская Гавань',
        status: 'approve'
      },
    ]
  },
  mutations: {
    CREATE_LEAD (state, payload) {
      state.leads.push(payload)
    }
  },
  actions: {
    create_lead ({ commit }, payload) {
      payload.id = Math.random()

      commit('CREATE_LEAD', payload)
    }
  },
  getters: {
    leads(state) {
      return state.leads
    },
    rejectLeads(state) {
      return state.leads.filter(lead => {
          return lead.status === 'reject'
        })
    },
    inProcessLeads(state) {
      return state.leads.filter(lead => {
          return lead.status === 'in process'
        })
    },
    approveLeads(state) {
      return state.leads.filter(lead => {
          return lead.status === 'approve'
        })
    },
    myLeads(state) {
      return state.leads
    },
    getLeadById (state) {
      return leadId => {
        return state.leads.find(lead => lead.id == leadId)
      }
    }
  },
}
