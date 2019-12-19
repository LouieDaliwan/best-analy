import Vue from 'vue'
import Vuex from 'vuex'
import { appbar } from './modules/appbar'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    appbar,
  },

  strict: process.env.NODE_ENV !== 'production'
})
