import store from '@/store'

export default function metatags(to, from, next) {
  const route = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

  if (route && route.meta) {
    let routeTitle = route.meta.title
    let routeDescription = route.meta.description
    let appTitle = store.getters['app/title']

    document.title = routeTitle ? `${routeTitle} | ${appTitle}` : appTitle;

    if (routeDescription) {
      document
        .querySelector('head meta[name="description"]')
        .setAttribute('content', routeDescription)
    }
  }

  next();
}
