export default [
  {
    code: 'companies',
    name: 'companies',
    meta: {
      title: 'Company',
      icon: 'mdi-briefcase',
      authenticatable: true,
      sort: 5,
      permission: ['customers.index', 'customers.owned'],
      children: ['companies.index', 'companies.show', 'companies.owned', 'companies.find', 'companies.preview', 'companies.survey', 'companies.trashed'],
    },
    children: [
      {
        code: 'companies.index',
        name: 'companies.index',
        meta: {
          title: 'All Companies',
          authenticatable: true,
          sort: 5,
          permission: 'customers.index',
          children: ['companies.index', 'companies.show', 'companies.reports', 'companies.survey'],
        },
      },
      {
        code: 'companies.owned',
        name: 'companies.owned',
        meta: {
          title: 'My Companies',
          authenticatable: true,
          sort: 5,
          'viewable:superadmins': false,
          permission: 'customers.owned',
          children: ['companies.owned'],
        },
      },
      {
        code: 'companies.find',
        name: 'companies.find',
        meta: {
          title: 'Find Company',
          authenticatable: true,
          sort: 6,
          permission: 'customers.index',
        },
      },
      {
        code: 'companies.trashed',
        name: 'companies.trashed',
        meta: {
          title: 'Trashed Companies',
          authenticatable: true,
          sort: 5,
          permission: 'customers.trashed',
          children: ['companies.trashed'],
        },
      },
    ],
  }
]
