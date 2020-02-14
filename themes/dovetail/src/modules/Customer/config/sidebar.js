export default [
  {
    code: 'customers',
    name: 'customers',
    meta: {
      title: 'Customer',
      icon: 'mdi-account-multiple-outline',
      authenticatable: true,
      sort: 5,
      permission: ['customers.index', 'customers.owned'],
      children: ['customers.index', 'customers.show', 'customers.owned', 'customers.generate', 'customers.survey', 'customers.trashed'],
    },
    children: [
      {
        code: 'customers.index',
        name: 'customers.index',
        meta: {
          title: 'All Customers',
          authenticatable: true,
          sort: 5,
          permission: 'customers.index',
          children: ['customers.index', 'customers.show', 'customers.survey'],
        },
      },
      {
        code: 'customers.owned',
        name: 'customers.owned',
        meta: {
          title: 'My Customers',
          authenticatable: true,
          sort: 5,
          permission: 'customers.owned',
          children: ['customers.owned'],
        },
      },
      {
        code: 'customers.generate',
        name: 'customers.generate',
        meta: {
          title: 'Generate Report',
          authenticatable: true,
          sort: 6,
          permission: 'customers.index',
        },
      },
      {
        code: 'customers.trashed',
        name: 'customers.trashed',
        meta: {
          title: 'Trashed Customers',
          authenticatable: true,
          sort: 5,
          permission: 'customers.trashed',
          children: ['customers.trashed'],
        },
      },
    ],
  }
]
