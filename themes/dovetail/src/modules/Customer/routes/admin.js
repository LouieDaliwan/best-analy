export default [
  {
    path: '/admin/companies',
    name: 'admin.companies',
    redirect: {name: 'companies.index'},
    component: () => import('@/App.vue'),
    meta: {
      title: 'Company',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      {
        path: '/admin/companies',
        name: 'companies.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'All Company',
          sort: 6,
          authenticatable: true,
          permission: 'customers.index',
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'owned',
        name: 'companies.owned',
        component: () => import('../Owned.vue'),
        meta: {
          title: 'My Company',
          description: 'Manage owned companies Performance Indices',
          sort: 6,
          authenticatable: true,
          permission: 'customers.owned',
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'find',
        props: true,
        name: 'companies.find',
        component: () => import('../Find.vue'),
        meta: {
          title: 'Find Company',
          sort: 6,
          authenticatable: true,
          permission: 'crm.search',
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'trashed',
        name: 'companies.trashed',
        component: () => import('../Trashed.vue'),
        meta: {
          title: 'Trashed Company',
          sort: 6,
          authenticatable: true,
          permission: 'customers.trashed',
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: ':id/edit',
        name: 'companies.edit',
        component: () => import('../Edit.vue'),
        meta: {
          title: ':slug',
          sort: 8,
          authenticatable: true,
          permission: 'customers.edit',
        },
      },
      {
        path: ':id/overall/reports',
        name: 'reports.overall',
        component: () => import('../Overall.vue'),
        meta: {
          title: 'Overall Report',
          sort: 9,
          authenticatable: true,
          permission: 'customers.show',
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: ':id/ratios/reports',
        name: 'reports.ratios',
        component: () => import('../Ratio.vue'),
        meta: {
          title: 'Financial Analysis',
          sort: 9,
          authenticatable: true,
          permission: 'customers.show',
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: ':id/reports',
        name: 'companies.reports',
        component: () => import('../Reports.vue'),
        meta: {
          title: ':slug',
          sort: 8,
          authenticatable: true,
          permission: 'customers.reports',
        },
      },
      {
        path: ':id/reports/:report',
        name: 'reports.show',
        component: () => import('../Report.vue'),
        meta: {
          title: 'Report Preview',
          sort: 9,
          authenticatable: true,
          permission: 'customers.show',
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: ':id',
        name: 'companies.show',
        component: () => import('../Show.vue'),
        meta: {
          title: 'Indexes',
          sort: 9,
          authenticatable: true,
          permission: 'customers.show',
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: ':id/:taxonomy/:survey',
        name: 'companies.survey',
        component: () => import('../Survey.vue'),
        meta: {
          title: ':slug',
          sort: 9,
          authenticatable: true,
          permission: 'customers.show',
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: ':id/:taxonomy/:survey/response',
        name: 'companies.response',
        component: () => import('../Response.vue'),
        meta: {
          title: ':slug',
          sort: 9,
          authenticatable: true,
          permission: 'customers.show',
          icon: 'mdi-book-multiple-variant',
        },
      },
    ],
  }
]
