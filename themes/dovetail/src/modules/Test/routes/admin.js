export default [
  {
    path: '/admin/tests',
    component: () => import('@/App.vue'),
    meta: {
      title: 'Tests',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-flask',
    },
    children: [
      {
        path: '',
        props: true,
        name: 'tests.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'All Tests',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-flask',
        },
      },
    ],
  }
]
