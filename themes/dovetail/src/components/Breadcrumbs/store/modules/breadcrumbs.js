export const state = () => ({
  breadcrumbs: {
    show: true,
  }
})

export const getters = {
  breadcrumbs: state => state.breadcrumbs,
  isShowing: state => state.breadcrumbs.show,
}

export const mutations = {
  'SET' (state, payload) {
    state.breadcrumbs.items = payload.items
  },

  'TOGGLE' (state, payload) {
    state.breadcrumbs.show = payload.show
  },
}

export const actions = {
  set: ({ commit }, payload) => {
    commit('SET', payload)
  },

  text: ({ commit }, payload) => {
    commit('SET_TEXT', payload)
  },

  toggle: ({ commit }, payload) => {
    commit('TOGGLE', payload)
  },
}

export const breadcrumbs = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
