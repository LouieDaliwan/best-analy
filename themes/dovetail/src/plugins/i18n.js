import Vue from 'vue'
import VueI18n from 'vue-i18n'
import en from '@/lang/en.json'
import ar from '@/lang/ar.json'

Vue.use(VueI18n)

export const messages = {
  en,
  ar,
}

const i18n = new VueI18n({
  locale: localStorage.getItem('app:locale') || 'en',
  fallbackLocale: window.$app.fallback_locale,
  silentFallbackWarn: true,
  silentTranslationWarn: true,
  messages
})

window.$trans = function (text, options = null) {
  return i18n.tc(text, options)
}

window.trans = function (text, options = null) {
  console.log(text, options)
  return i18n.tc(text, options)
}

export default i18n
