export const state = () => ({
  glance: {
    title: 'Test',
    count: '12',
    icon: 'mdi-account-outline'
  }
})

export const getters = {
  glance: state => state.glance
}

export const mutations = {
  emptyState () {
    this.replaceState({ glance: null })
  }
}

export const glance = {
  namespaced: true,
  state,
  getters,
  mutations
}
