export default [
  {
    path: 'faq',
    name: 'admin.faq',
    redirect: {name: 'faq.index'},
    component: () => import('@/App.vue'),
    meta: {
      title: 'FAQs',
      sort: 6,
      authenticatable: false,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      {
        path: '',
        name: 'faq.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'Frequently Asked Questions',
          sort: 6,
          authenticatable: false,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'video',
        props: true,
        name: 'faq.single',
        component: () => import('../Single.vue'),
        meta: {
          title: 'Single',
          sort: 7,
          authenticatable: false,
          icon: 'mdi-book-multiple-variant',
        },
      },
    ]
  }
]
