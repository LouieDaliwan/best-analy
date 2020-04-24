export default [
  {
    path: '/admin/indices',
    name: 'admin.indices',
    redirect: {name: 'indices.index'},
    component: () => import('@/App.vue'),
    meta: {
      title: 'Index',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      {
        path: '/admin/indices',
        name: 'indices.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'All Index',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'create',
        props: true,
        name: 'indices.create',
        component: () => import('../Create.vue'),
        meta: {
          title: 'Add Index',
          sort: 7,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'trashed',
        name: 'indices.trashed',
        component: () => import('../Trashed.vue'),
        meta: {
          title: 'Trashed Index',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'settings',
        name: 'indices.settings',
        component: () => import('../Settings.vue'),
        meta: {
          title: 'Settings Index',
          sort: 7,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'edit/:id',
        name: 'indices.edit',
        component: () => import('../Edit.vue'),
        meta: {
          title: ':slug',
          sort: 9,
          authenticatable: true,
        },
      },
    ],
  }
]
