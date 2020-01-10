import Vue from 'vue'
import Vuex from 'vuex'
import { shortkey } from './modules/shortkey'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    shortkey,
  },
  strict: process.env.NODE_ENV !== 'production'
})
