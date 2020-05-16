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
      children: ['users.index', 'users.create', 'users.edit', 'users.show', 'users.trashed', 'permissions.index', 'roles.index', 'roles.create', 'roles.edit', 'roles.show', 'roles.trashed'],
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
      // Role
      {
        code: 'roles.index',
        name: 'roles.index',
        meta: {
          title: 'Roles',
          authenticatable: true,
          icon: 'mdi-shield-account-outline',
          sort: 6,
          permission: 'roles.index',
          children: ['roles.index', 'roles.create', 'roles.edit', 'roles.show', 'roles.trashed'],
        }
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
          permission: 'permissions.index',
          children: ['permissions.index'],
        }
      },
    ],
  }
]
