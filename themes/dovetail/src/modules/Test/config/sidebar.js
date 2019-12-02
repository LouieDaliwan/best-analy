export default [
  {
    code: 'tests',
    name: 'tests',
    meta: {
      title: 'Tests',
      icon: 'mdi-code-braces',
      authenticatable: true,
      sort: 5,
    },
    children: [
      // Admin Tests
      {
        code: 'tests.index',
        name: 'tests.index',
        meta: {
          title: 'All Tests',
          icon: 'mdi-book-multiple-variant',
          authenticatable: true,
          sort: 5,
        },
      },
    ],
  }
]
