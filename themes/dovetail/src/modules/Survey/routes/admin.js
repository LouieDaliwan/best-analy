export default [
  {
    path: '/admin/surveys',
    name: 'admin.surveys',
    redirect: {name: 'surveys.index'},
    component: () => import('@/App.vue'),
    meta: {
      title: 'Survey',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      {
        path: '/admin/surveys',
        name: 'surveys.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'All Survey',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'trashed',
        name: 'surveys.trashed',
        component: () => import('../Trashed.vue'),
        meta: {
          title: 'Trashed Survey',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'create',
        props: true,
        name: 'surveys.create',
        component: () => import('../Create.vue'),
        meta: {
          title: 'Add Survey',
          sort: 7,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'edit/:id',
        name: 'surveys.edit',
        component: () => import('../Edit.vue'),
        meta: {
          title: ':slug',
          sort: 8,
          authenticatable: true,
        },
      },
      {
        path: ':id',
        name: 'surveys.show',
        component: () => import('../Show.vue'),
        meta: {
          title: ':slug',
          sort: 9,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
    ],
  }
]
