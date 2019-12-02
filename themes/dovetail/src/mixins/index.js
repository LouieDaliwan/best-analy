import localstorage from './localstorage.js'
import trans from './trans.js'
import Vue from 'vue'

const mixins = {
  install (Vue) {
    Vue.mixin(localstorage)
    Vue.mixin(trans)
  }
}

Vue.use(mixins)
