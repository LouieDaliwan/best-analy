export const state = () => ({
  account: {
  }
})

export const getters = {
  account: state => state.account
}

export const mutations = {
  'SET' (state, payload) {
    state.account.items = payload.items
  },
}

export const actions = {
  set: ({ commit }, payload) => {
    commit('SET', payload)
  },

  toggle: ({ commit }, payload) => {
    commit('TOGGLE', payload)
  },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
