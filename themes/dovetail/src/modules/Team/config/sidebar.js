export default [
  {
    code: 'teams',
    name: 'teams',
    meta: {
      title: 'Team',
      icon: 'mdi-account-multiple-outline',
      authenticatable: true,
      sort: 5,
      permission: ['teams.index', 'teams.owned'],
      children: ['teams.index', 'teams.create', 'teams.owned', 'teams.show', 'teams.edit', 'teams.trashed', 'teams.reports', 'teams.overall', 'teams.report'],
    },
    children: [
      {
        code: 'teams.index',
        name: 'teams.index',
        meta: {
          title: 'All Teams',
          authenticatable: true,
          sort: 5,
          permission: 'teams.index',
          children: ['teams.index', 'teams.edit', 'teams.show'],
        },
      },
      {
        code: 'teams.owned',
        name: 'teams.owned',
        meta: {
          title: 'My Team',
          authenticatable: true,
          sort: 6,
          permission: 'teams.owned',
          children: ['teams.index', 'teams.edit', 'teams.show', 'teams.reports', 'teams.overall', 'teams.report'],
        },
      },
      {
        code: 'teams.create',
        name: 'teams.create',
        meta: {
          title: 'Add Team',
          authenticatable: true,
          sort: 6,
          permission: 'teams.create',
        },
      },
      {
        code: 'teams.trashed',
        name: 'teams.trashed',
        meta: {
          title: 'Trashed Teams',
          authenticatable: true,
          sort: 5,
          permission: 'teams.trashed',
        },
      },
    ],
  }
]
