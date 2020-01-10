export const state = () => ({
  appbar: {
    model: true,
    items: [],
  }
})

export const getters = {
  appbar: state => state.appbar
}

export const mutations = {
  'SET' (state, payload) {
    state.appbar.items = payload.items
  },

  'TOGGLE' (state, payload) {
    state.appbar.model = payload.model
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
