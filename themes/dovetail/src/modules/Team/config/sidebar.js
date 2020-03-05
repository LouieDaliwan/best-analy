export default [
  {
    code: 'teams',
    name: 'teams',
    meta: {
      title: 'Team',
      icon: 'mdi-account-multiple-outline',
      authenticatable: true,
      sort: 5,
      permission: 'teams.index',
      children: ['teams.index', 'teams.create', 'teams.edit', 'teams.trashed'],
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
          children: ['teams.index', 'teams.edit'],
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
    ],
  }
]
