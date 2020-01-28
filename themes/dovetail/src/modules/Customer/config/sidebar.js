export default [
  {
    code: 'customers',
    name: 'customers',
    meta: {
      title: 'Customer',
      icon: 'mdi-account-multiple-outline',
      authenticatable: true,
      sort: 5,
      permission: 'customers.index',
      children: ['customers.index', 'customers.show', 'customers.search'],
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
          children: ['customers.index', 'customers.show'],
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
          children: ['customers.show'],
        },
      },
      {
        code: 'customers.search',
        name: 'customers.search',
        meta: {
          title: 'Generate Report',
          authenticatable: true,
          sort: 6,
          permission: 'customers.index',
        },
      },
    ],
  }
]
