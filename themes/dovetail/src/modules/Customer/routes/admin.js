export default [
  {
    path: '/admin/customers',
    name: 'admin.customers',
    redirect: {name: 'customers.index'},
    component: () => import('@/App.vue'),
    meta: {
      title: 'Customers',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      {
        path: '/admin/customers',
        name: 'customers.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'All Customers',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'my',
        name: 'customers.owned',
        component: () => import('../Owned.vue'),
        meta: {
          title: 'My Customers',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'search',
        props: true,
        name: 'customers.search',
        component: () => import('../Search.vue'),
        meta: {
          title: 'Generate Report',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: ':id',
        name: 'customers.show',
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
