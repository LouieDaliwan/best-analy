export default [
  {
    path: '/admin/teams',
    name: 'admin.teams',
    redirect: {name: 'teams.index'},
    component: () => import('@/App.vue'),
    meta: {
      title: 'Teams',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      {
        path: '/admin/teams',
        name: 'teams.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'All Teams',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: '/admin/teams/owned',
        name: 'teams.owned',
        component: () => import('../Owned.vue'),
        meta: {
          title: 'My Team',
          sort: 7,
          authenticatable: true,
          permission: 'teams.owned',
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'create',
        props: true,
        name: 'teams.create',
        component: () => import('../Create.vue'),
        meta: {
          title: 'Add Team',
          sort: 7,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'trashed',
        name: 'teams.trashed',
        component: () => import('../Trashed.vue'),
        meta: {
          title: 'Trashed Index',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'edit/:id',
        name: 'teams.edit',
        component: () => import('../Edit.vue'),
        meta: {
          title: ':slug',
          sort: 9,
          authenticatable: true,
        },
      },
      {
        path: ':id',
        name: 'teams.show',
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
