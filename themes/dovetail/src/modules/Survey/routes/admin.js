export default [
  {
    path: '/admin/surveys',
    component: () => import('@/App.vue'),
    meta: {
      title: 'Survey',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-flask',
    },
    children: [
      {
        path: '',
        props: true,
        name: 'surveys.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'All Survey',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-flask',
        },
      },
    ],
  }
]
