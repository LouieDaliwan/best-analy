import config from '@/config/app'
import VM from '@/mixins/localstorage'

export const state = () => ({
  app: {
    meta: config,
    dark: VM.methods.localstorage('app.dark', 'true') === 'true' || config.dark,
  },
})

export const getters = {
  app: state => state.app,
}

export const mutations = {
  'TOGGLE_DARK_THEME' (state, payload) {
    state.app.dark = payload.dark
  },

  'UPDATE' (state, payload) {
    state.app = Object.assign({}, state.app, payload)
  },
}

export const actions = {
  theme: ({commit}, payload) => {
    VM.methods.localstorage({'app.dark': payload.dark})
    commit('TOGGLE_DARK_THEME', payload)
  },

  update: ({commit}, payload) => {
    VM.methods.localstorage({'app.dark': payload.dark})
    commit('UPDATE', payload)
  },
}

export const app = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}
