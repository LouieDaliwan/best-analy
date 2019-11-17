export default [
  {
    path: '/admin/appearance',
    component: () => import('@/App.vue'),
    meta: {
      title: 'Appearance',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      //Menus
      {
        path: 'menus',
        props: true,
        name: 'appearance.menus',
        component: () => import('../submodules/Menu/Index.vue'),
        meta: {
          title: 'Menus',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: ':code/edit',
        props: true,
        name: 'appearance.edit',
        component: () => import('../submodules/Menu/Edit.vue'),
        meta: {
          title: 'Edit Menus',
          sort: 7,
          external: true,
          excludeFromRoot: true,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      // Themes
      {
        path: 'themes',
        props: true,
        name: 'appearance.themes',
        component: () => import('../submodules/Theme/Index.vue'),
        meta: {
          title: 'Themes',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      }
    ],
  }
]
