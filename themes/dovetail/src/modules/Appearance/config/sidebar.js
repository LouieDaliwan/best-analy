export default [
  {
    code: 'appearance',
    name: 'appearance',
    meta: {
      title: 'Appearance',
      icon: 'mdi-palette',
      authenticatable: true,
      sort: 500,
      permission: 'appearance.menus',
    },
    children: [
      // Menu Appearance
      {
        code: 'appearance.menus',
        name: 'appearance.menus',
        meta: {
          title: 'Menus',
          authenticatable: true,
          sort: 501,
          permission: 'appearance.menus',
        },
      },
      // Theme Appearance
      {
        code: 'appearance.themes',
        name: 'appearance.themes',
        meta: {
          title: 'Themes',
          authenticatable: true,
          sort: 502,
          permission: 'appearance.themes',
        }
      }
    ],
  }
]
