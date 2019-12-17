import localstorage from './localstorage.js'
import page from './page.js'
import trans from './trans.js'
import Vue from 'vue'

const mixins = {
  install (Vue) {
    Vue.mixin(localstorage)
    Vue.mixin(page)
    Vue.mixin(trans)
  }
}

Vue.use(mixins)
