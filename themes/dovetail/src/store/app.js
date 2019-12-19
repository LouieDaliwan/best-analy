export const state = () => ({
  app: {
    dark: localStorage.getItem('theme:dark') === 'true' || false,
  },
})

export const getters = {
  app: state => state.app,
  title: state => state.app['app:title'],
  tagline: state => state.app['app:tagline'],
  year: state => state.app['app:year'],
  author: state => state.app['app:author'],
}

export const mutations = {
  'SET' (state, payload) {
    state.app = window._.merge({}, state.app, payload)
  },
}

export const actions = {
  set: ({commit}, payload) => {
    commit('SET', payload)
  },
}

export const app = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}
