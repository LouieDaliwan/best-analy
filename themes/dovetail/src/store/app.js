import $api from '@/routes/api'
import i18n from '@/plugins/i18n'

export const state = ({
  app: {
    dark: localStorage.getItem('theme:dark') === 'true' || false,
    title: window.$app.meta['app:title'],
    tagline: window.$app.meta['app:tagline'],
    copyright: window.$app.meta['app:copyright'],
    email: window.$app.meta['app:email'],
    year: window.$app.meta['app:year'],
    author: window.$app.meta['app:author'],
    logo: window.$app.logo,
    locale: window.$app.locale,
  },
})

export const getters = {
  dark: state => state.app.dark,
  title: state => state.app['app:title'],
  tagline: state => state.app['app:tagline'],
  year: state => state.app['app:year'],
  author: state => state.app['app:author'],
  locale: state => state.app.locale,
}

export const mutations = {
  'SET_APP' (state, payload) {
    state.app = window._.merge({}, state.app, payload)
  },

  'SET_LOCALE' (state, locale) {
    state.app.locale = locale
    i18n.locale = locale
    // localStorage.setItem('app:locale', locale)
  }
}

export const actions = {
  set: ({ commit }, payload) => {
    commit('SET_APP', payload)
  },

  locale: function ({ commit }, locale) {
    commit('SET_LOCALE', locale)
  },
}

export const app = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}
