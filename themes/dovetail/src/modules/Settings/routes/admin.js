export default [
  {
    path: '/admin/settings',
    component: () => import('@/App.vue'),
    meta: {
      title: 'Settings',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      // General
      {
        path: 'general',
        props: true,
        name: 'settings.general',
        component: () => import('../General.vue'),
        meta: {
          title: 'General',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      // Branding
      {
        path: 'branding',
        props: true,
        name: 'settings.branding',
        component: () => import('../Branding.vue'),
        meta: {
          title: 'Branding',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      // System
      {
        path: 'system',
        props: true,
        name: 'settings.system',
        component: () => import('../System.vue'),
        meta: {
          title: 'System',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
    ],
  }
]
