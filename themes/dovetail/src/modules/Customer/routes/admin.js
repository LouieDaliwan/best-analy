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
        path: 'trashed',
        name: 'customers.trashed',
        component: () => import('../Trashed.vue'),
        meta: {
          title: 'Trashed Customers',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'owned',
        name: 'customers.owned',
        component: () => import('../Owned.vue'),
        meta: {
          title: 'My Customers',
          description: 'Manage owned customers Performance Indices',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'generate',
        props: true,
        name: 'customers.generate',
        component: () => import('../Generate.vue'),
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
          title: 'Indexes',
          sort: 9,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: ':id/:taxonomy/:survey',
        name: 'customers.survey',
        component: () => import('../Survey.vue'),
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
