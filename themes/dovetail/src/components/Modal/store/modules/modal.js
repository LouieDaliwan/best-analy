import store from '@/store'

export const state = () => ({
  modal: {
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
          store.dispatch('modal/prompt', {show: false})
        },
      },

      cancel: {
        show: true,
        color: 'dark',
        text: 'Cancel',
        callback: () => {
          store.dispatch('modal/prompt', {show: false})
        },
      },
    },
  }
})

export const getters = {
  modal: state => state.modal
}

export const mutations = {
  PROMPT_MODAL(state, payload) {
    state.modal = window._.merge({}, state.modal, payload)
  },
}

export const actions = {
  prompt: (context, payload) => {
    context.commit('PROMPT_MODAL', payload)
  },
}

export const modal = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}
