import Vue from 'vue'
import Vuex from 'vuex'
import app from '@/store/globals/app'
import theme from '@/store/globals/theme'
import modules from '@/store/modules'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules,
  // Making sure that we're doing
  // everything correctly by enabling
  // strict mode in the dev environment.
  strict: process.env.NODE_ENV !== 'production'
})

store.registerModule('app', app)
store.registerModule('theme', theme)

export default store

// store.registerModule
