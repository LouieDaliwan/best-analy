import store from '@/store'
import ErrorIcon from '@/components/Icons/ErrorIcon.vue'

export const state = () => ({
  dialog: {
    // Toggle
    show: false,
    loading: false,

    // Settings
    persistent: false,
    width: null,
    maxWidth: 800,
    color: null,
    light: null,
    dark: null,

    // Illustration
    illustration: () => import('@/components/Icons/ErrorIcon.vue'),
    illustrationWidth: 300,
    illustrationHeight: 300,

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
    state.dialog = window._.merge({}, state.dialog, payload, {loading: false})
  },

  PROMPT_ERROR (state, payload) {
    state.dialog = window._.merge({}, state.dialog, {
      show: true,
      loading: false,
      illustration: () => import('@/components/Icons/ErrorIcon.vue'),
      buttons: {
        cancel: { show: false },
        action: {
          text: 'Okay',
          color: null,
          callback: () => {
            store.dispatch('dialog/error', {show: false})
          },
        }
      }
    }, payload)
  },
}

export const actions = {
  prompt: (context, payload) => {
    context.commit('PROMPT_DIALOG', payload)
  },

  error: (context, payload) => {
    context.commit('PROMPT_ERROR', payload)
  },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}
