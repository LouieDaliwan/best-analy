import Vue from 'vue'
import Vuex from 'vuex'
import { repeater } from './modules/repeater'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    repeater,
  },
  strict: process.env.NODE_ENV !== 'production'
})
