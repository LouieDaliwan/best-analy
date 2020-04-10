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
    },
    children: [
      // General
      // {
      //   code: 'settings.general',
      //   name: 'settings.general',
      //   meta: {
      //     title: 'General',
      //     authenticatable: true,
      //     sort: 501,
      //     permission: 'settings.preferences',
      //   },
      // },
      // Branding
      {
        code: 'settings.branding',
        name: 'settings.branding',
        meta: {
          title: 'Branding',
          authenticatable: true,
          sort: 501,
          permission: 'settings.branding',
        },
      },
      // Formula
      // {
      //   code: 'settings.formulas',
      //   name: 'best.formulas',
      //   meta: {
      //     title: 'Formulas',
      //     authenticatable: true,
      //     permission: 'best.formulas',
      //     sort: 501,
      //   },
      //   permission: 'settings.formulas',
      // },
      // System
      // {
      //   code: 'settings.system',
      //   name: 'settings.system',
      //   meta: {
      //     title: 'System',
      //     authenticatable: true,
      //     sort: 501,
      //   },
      //   permission: 'settings.system',
      // },
    ],
  }
]
