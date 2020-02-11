export default [
  {
    code: 'surveys',
    name: 'surveys',
    meta: {
      title: 'Survey',
      icon: 'mdi-table',
      authenticatable: true,
      sort: 5,
      permission: 'surveys.index',
      children: ['surveys.index', 'surveys.create', 'surveys.edit', 'surveys.show', 'surveys.trashed', 'submissions.index', 'submissions.show'],
    },
    children: [
      {
        code: 'surveys.index',
        name: 'surveys.index',
        meta: {
          title: 'All Surveys',
          authenticatable: true,
          sort: 5,
          permission: 'surveys.index',
          children: ['surveys.index', 'surveys.edit', 'surveys.show'],
        },
      },
      {
        code: 'surveys.create',
        name: 'surveys.create',
        meta: {
          title: 'Add Survey',
          authenticatable: true,
          sort: 6,
          permission: 'surveys.create',
        },
      },
      {
        code: 'surveys.trashed',
        name: 'surveys.trashed',
        meta: {
          title: 'Trashed Surveys',
          authenticatable: true,
          sort: 5,
          permission: 'surveys.trashed',
        },
      },
    ],
  }
]
