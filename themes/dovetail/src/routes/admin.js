import store from '@/store'
import $api from '@/routes/api'
import metatags from '@/routes/helpers/metatags';

const routes = []
const requireRoute = require.context(
  // The relative path of the routes folder
  '@/modules',
  // Whether or not to look in subfolders
  true,
  // The regular expression used to match base route filenames
  /routes\/admin\.js$/
)

requireRoute.keys().forEach(route => {
  const routeConfig = requireRoute(route)

  routeConfig.default.forEach(route => {
    routes.push(route)
  })
})

export default {
  path: '/admin',
  name: 'admin',
  redirect: { name: 'dashboard' },
  component: () => import('@/components/Layouts/Admin.vue'),
  meta: { title: 'Admin', authenticatable: true },
  children: routes,
  beforeEnter: (to, from, next) => {
    metatags.set(to, from, next)

    window.axios.post($api.validate.token)
      .then(response => {
        next();
      })
      .catch(error => {
        next({name: 'login'});
      });

    const isAuthenticated = store.getters['auth/isAuthenticated']
    if (!isAuthenticated) {
      return next({name: 'login'})
    }
    return next()
  }
}
