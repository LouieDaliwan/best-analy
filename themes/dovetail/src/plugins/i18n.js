import Vue from 'vue'
import VueI18n from 'vue-i18n'
import store from '@/store'
import en from '@/lang/en.json'
import fil from '@/lang/fil.json'

Vue.use(VueI18n)

const messages = {
  en,
  fil,
  ja: {
    'hello': 'こんにちは、世界',
    'Great success': '大成功',
  }
} // TODO: replace this of course.

const i18n = new VueI18n({
  locale: localStorage.getItem('app:locale') || 'en',
  fallbackLocale: 'en',
  silentFallbackWarn: true,
  silentTranslationWarn: true,
  messages
})

window.$trans = function (text) {
  return i18n.tc(text)
}

export default i18n
