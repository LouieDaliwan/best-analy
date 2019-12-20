import Vue from 'vue'
import VueI18n from 'vue-i18n'
import $app from '@/config/app'
import fil from '@/../lang/fil.json'

Vue.use(VueI18n)

const messages = {
  en: {hello: 'hello'},
  fil: fil,
  ja: {
    'hello': 'こんにちは、世界',
    'Great success': '大成功',
  }
} // TODO: replace this of course.

const i18n = new VueI18n({
  locale: $app.locale || 'en',
  fallbackLocale: 'en',
  silentFallbackWarn: true,
  silentTranslationWarn: true,
  messages
})

window.$trans = function (text) {
  return i18n.tc(text)
}

export default i18n
