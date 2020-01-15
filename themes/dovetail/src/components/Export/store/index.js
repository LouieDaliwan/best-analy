import Vue from 'vue'
import Vuex from 'vuex'
import { export } from './modules/export'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    export
  },
  strict: process.env.NODE_ENV !== 'production'
})
