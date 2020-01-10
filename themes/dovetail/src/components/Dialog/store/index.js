import Vue from 'vue'
import Vuex from 'vuex'
import { dialog } from './modules/dialog'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    dialog
  },
  strict: process.env.NODE_ENV !== 'production'
})
