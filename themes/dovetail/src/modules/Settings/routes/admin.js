export default [
  {
    path: 'settings',
    name: 'settings',
    component: () => import('../Branding.vue'),
    meta: {
      title: 'Settings',
      description: 'Overview of the app.',
      sort: 0,
      authenticatable: true,
      permission: false,
      icon: 'settings',
    },
  },
]
