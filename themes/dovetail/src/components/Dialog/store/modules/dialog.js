import store from '@/store'

export const state = () => ({
  dialog: {
    // Toggle
    show: false,

    // Settings
    persistent: false,
    width: null,
    maxWidth: 800,

    // Text
    title: false,
    text: false,

    // Alignment
    alignment: false, // e.g. 'center'

    // Buttons
    buttons: {
      action: {
        show: true,
        color: 'primary',
        text: 'Okay',
        callback: () => {
          store.dispatch('dialog/prompt', {show: false})
        },
      },

      cancel: {
        show: true,
        color: 'dark',
        text: 'Cancel',
        callback: () => {
          store.dispatch('dialog/prompt', {show: false})
        },
      },
    },
  }
})

export const getters = {
  dialog: state => state.dialog
}

export const mutations = {
  PROMPT_DIALOG (state, payload) {
    state.dialog = window._.merge({}, state.dialog, payload)
  },
}

export const actions = {
  prompt: (context, payload) => {
    context.commit('PROMPT_DIALOG', payload)
  },
}

export const dialog = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}
