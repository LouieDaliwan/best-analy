import Vue from 'vue'
import Vuetify from 'vuetify/lib'
import * as theme from '../../theme.json'

Vue.use(Vuetify)

export default new Vuetify({
  rtl: localStorage.getItem('app:rtl') == 'true' || false,
  icons: {
    iconfont: 'mdi',
  },
  theme: {
    options: {
      minifyTheme: function (css) {
        return process.env.NODE_ENV === 'production'
          ? css.replace(/[\r\n|\r|\n]/g, '')
          : css
      },
    },
    themes: {
      light: theme.colors.light,
      dark: theme.colors.dark,
    },
  },
})
