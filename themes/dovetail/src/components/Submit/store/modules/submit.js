export const state = () => ({
  dataset: {
    class: 'primary',
    label: 'Test',
  }
})

export const getters = {
  submit: state => state.submit
}

export const mutations = {
  PROMPT_DIALOG (state, payload) {
    payload = Object.assign(state.submit, payload)
    state.submit = payload
  },

  emptyState () {
    this.replaceState({ submit: null })
  }
}

export const submit = {
  namespaced: true,
  state,
  getters,
  mutations
}
