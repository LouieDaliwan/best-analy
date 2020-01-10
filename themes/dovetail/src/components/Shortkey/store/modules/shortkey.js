
export const state = () => ({
  shortkey: {
    ctrlIsPressed: false,
    altIsPressed: false,
  },
})

export const getters = {
  shortkey: state => state.shortkey,
  ctrlIsPressed: state => state.shortkey.ctrlIsPressed,
  altIsPressed: state => state.shortkey.altIsPressed,
}

export const mutations = {
  'PRESS' (state, payload) {
    state.shortkey = window._.merge({}, state.shortkey, payload)
  },
}

export const actions = {
  press: ({ commit }, payload) => {
    commit('PRESS', payload)
  },
}

export const shortkey = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}
