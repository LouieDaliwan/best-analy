export default [
  {
    path: 'settings',
    name: 'settings',
    component: () => import('../General.vue'),
    meta: {
      title: 'Settings',
      sort: 600,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
  }
]
