import Vue from 'vue'
import Vuex from 'vuex'
import { glance } from './modules/glance'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    glance
  },
  strict: process.env.NODE_ENV !== 'production'
})
