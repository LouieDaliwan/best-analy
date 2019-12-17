export default [
  {
    code: 'users',
    name: 'users',
    meta: {
      title: 'User',
      icon: 'mdi-account-settings',
      authenticatable: true,
      sort: 5,
      permission: 'users.index',
    },
    children: [
      // Admin User
      {
        code: 'users.index',
        name: 'users.index',
        meta: {
          title: 'All Users',
          authenticatable: true,
          sort: 5,
          permission: 'users.index',
        },
      },
    ],
  }
]
