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
      children: ['users.index', 'users.create', 'users.edit', 'users.show', 'users.trashed', 'permissions.index'],
    },
    children: [
      {
        code: 'users.index',
        name: 'users.index',
        meta: {
          title: 'All Users',
          authenticatable: true,
          sort: 5,
          permission: 'users.index',
          children: ['users.index', 'users.edit', 'users.show'],
        },
      },
      {
        code: 'users.create',
        name: 'users.create',
        meta: {
          title: 'Add User',
          authenticatable: true,
          sort: 6,
          permission: 'users.create',
        },
      },
      {
        code: 'users.trashed',
        name: 'users.trashed',
        meta: {
          title: 'Deactivated Users',
          authenticatable: true,
          sort: 6,
          permission: 'users.trashed',
          children: ['users.trashed'],
        },
      },
      // Permissions
      {
        code: 'permissions.index',
        name: 'permissions.index',
        meta: {
          title: 'Permissions',
          authenticatable: true,
          icon: 'mdi-shield-lock',
          sort: 6,
          permission: 'users.index',
          children: ['permissions.index'],
        }
      },
    ],
  }
]
