export default [
  {
    path: '/admin/users',
    component: () => import('@/App.vue'),
    meta: {
      title: 'Users',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      {
        path: '',
        props: true,
        name: 'users.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'All Users',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
    ],
  }
]
