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
      // Preferences
      {
        path: 'preferences',
        props: true,
        name: 'settings.preferences',
        component: () => import('../Preferences.vue'),
        meta: {
          title: 'Preferences',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      // General Display
      {
        path: 'general/display',
        props: true,
        name: 'settings.general.display',
        component: () => import('../Display.vue'),
        meta: {
          title: 'Display',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      // Branding General
      {
        path: 'branding/general',
        props: true,
        name: 'settings.branding.general',
        component: () => import('../Branding.vue'),
        meta: {
          title: 'Branding',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      // Branding Email
      {
        path: 'branding/email',
        props: true,
        name: 'settings.branding.email',
        component: () => import('../Email.vue'),
        meta: {
          title: 'Email',
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
