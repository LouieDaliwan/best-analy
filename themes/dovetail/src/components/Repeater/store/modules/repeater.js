export const state = () => ({
  repeater: {
    defaults: [{key: '', value: ''}],
    template: {key: '', value: ''},
    items: [{key: '', value: ''}],
  }
})

export const getters = {
  items: state => state.repeater.items,
  defaults: state => state.repeater.defaults,
  template: state => state.repeater.template,
}

export const mutations = {
  'ADD' (state) {
    (state.repeater.items || []).push(state.repeater.template)
  },

  'REMOVE' (state, payload) {
    state.repeater.items.splice(payload, 1)
  },

  'SET' (state, payload) {
    state.repeater.items = window._.merge([], payload)
  }
}

export const actions = {
  add: ({ commit }) => {
    commit('ADD')
  },

  remove: ({ commit }, payload) => {
    commit('REMOVE', payload)
  },

  set: ({ commit }, payload) => {
    commit('SET', payload)
  },
}

export const repeater = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
