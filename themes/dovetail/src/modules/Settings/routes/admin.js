export default [
  {
    path: 'settings',
    name: 'settings',
    component: () => import('@/App.vue'),
    meta: {
      title: 'Settings',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      {
        path: 'general',
        name: 'settings.general',
        component: () => import('../General.vue'),
        meta: {
          title: 'General',
          sort: 600,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'taxonomy',
        name: 'settings.taxonomy',
        component: () => import('../Taxonomy.vue'),
        meta: {
          title: 'Taxonomy',
          sort: 600,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
    ],
  }
]
