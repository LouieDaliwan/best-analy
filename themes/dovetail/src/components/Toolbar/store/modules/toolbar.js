export const state = () => ({
  toolbar: {
    model: '',
    title: '',
    search: '',
    tooltipName: '',
    searchField: false,
    filter: false,
    sort: false,
    searchButton: true,
    listGridView: true,
    toggleview: true,
    showBulk: false,
  },
})

export const getters = {
  toolbar: state => state.toolbar
}

export const mutations = {
  emptyState () {
    this.replaceState({ toolbar: null })
  },

  'UPDATE' (state, payload) {
    state.toolbar = Object.assign(state.toolbar, payload)
  },
}

export const actions = {
  update: ({ commit }, payload) => {
    commit('UPDATE', payload)
  },
}

export const toolbar = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}
