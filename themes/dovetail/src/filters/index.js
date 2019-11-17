import slugify from './slugify'
import Vue from 'vue'

const filters = {
  install (Vue) {
    Vue.filter(slugify.name, slugify.filter)
  }
}

Vue.use(filters)
