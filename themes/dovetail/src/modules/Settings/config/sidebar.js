export default [
  {
    code: 'settings',
    name: 'settings',
    meta: {
      title: 'Settings',
      icon: 'mdi-tune',
      authenticatable: true,
      sort: 500,
      permission: 'settings.preferences',
      children: ['settings.general', 'settings.taxonomy'],
    },
    children: [
      {
        code: 'settings.general',
        name: 'settings.general',
        meta: {
          title: 'General',
          authenticatable: true,
          sort: 500,
          permission: 'settings.preferences',
        },
      },
      {
        code: 'settings.taxonomy',
        name: 'settings.taxonomy',
        meta: {
          title: 'Taxonomy',
          authenticatable: true,
          sort: 500,
          permission: 'settings.preferences',
        },
      },
    ],
  }
]
