import store from '@/store'

export default {
  set: function (to, from, next) {
    const route = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

    if (route && route.meta) {
      document.title = `${route.meta.title} | ${store.getters['app/title']}`;
      if (route.meta.metatags) {
        document
          .querySelector('head meta[name="description"]')
          .setAttribute('content', route.meta.metatags.description)
      }
    }
  },

  gettext: function (route, slugString) {
    if (route.meta.title == ':slug') {
      return slugString
    }

    return route.meta.title
  },
}
