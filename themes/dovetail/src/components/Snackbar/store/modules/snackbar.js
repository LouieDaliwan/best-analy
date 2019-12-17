import store from '@/store'

export const state = () => ({
  snackbar: {
    // Toggle
    show: false,

    // Typography
    text: 'text',
    icon: false,

    // Settings
    color: 'dark',
    timeout: 8000,
    mode: null, // e.g. multi-line, vertical

    // Position
    x: 'center',
    y: 'top',

    // Button
    button: {
      show: true,
      icon: false,
      text: 'Close',
      callback: () => { store.dispatch('snackbar/toggle', {show: false}) }
    },
  }
})

export const getters = {
  snackbar: state => state.snackbar,
  isShowing: state => state.snackbar.show,
}

export const mutations = {
  TOGGLE_TOAST: (state, payload) => {
    state.snackbar = window._.merge({}, state.snackbar, payload)
  },
}

export const actions = {
  toggle: (context, payload) => {
    context.commit('TOGGLE_TOAST', payload)
  },
}

export const snackbar = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
