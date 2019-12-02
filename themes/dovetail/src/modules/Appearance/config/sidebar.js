export default [
  {
    code: 'appearance',
    name: 'appearance',
    meta: {
      title: 'Appearance',
      icon: 'color_lens',
      authenticatable: true,
      sort: 500,
    },
    children: [
      // Menu Appearance
      {
        code: 'appearance.menus',
        name: 'appearance.menus',
        meta: {
          title: 'Menus',
          icon: 'home',
          authenticatable: true,
          sort: 501,
        },
      },
      // Theme Appearance
      {
        code: 'appearance.themes',
        name: 'appearance.themes',
        meta: {
          title: 'Themes',
          icon: 'mdi-palette',
          authenticatable: true,
          sort: 502,
        }
      }
    ],
  }
]
