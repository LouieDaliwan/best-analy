export default [
  {
    path: '/admin/tests',
    component: () => import('@/App.vue'),
    meta: {
      title: 'Tests',
      sort: 17,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      {
        path: '',
        name: 'tests.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'All Tests',
          sort: 17,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
    ],
  }
]
