// export default {
//   list: function () {
//     return '/api/v1/indices'
//   },
// }

export default {
  list: function () {
    return '/api/v1/customers'
  },

  owned: function () {
    return '/api/v1/customers/owned'
  },

  store: function () {
    return '/api/v1/customers'
  },

  show: function (id = null) {
    return `/api/v1/customers/${id}`
  },

  restore: function (id = null) {
    return `/api/v1/customers/restore/${id}`
  },

  update: function (id = null) {
    return `/api/v1/customers/${id}`
  },

  trashed: function () {
    return '/api/v1/customers/trashed'
  },

  destroy: function (id = null) {
    return `/api/v1/customers/${id}`
  },

  delete: function (id = null) {
    return `/api/v1/customers/delete/${id}`
  },

  indices: {
    list: function () {
      return '/api/v1/indices'
    },
  },

  surveys: {
    submit: function (id) {
      return `/api/v1/surveys/${id}/submit`
    },

    show: function (id) {
      return `/api/v1/surveys/${id}`
    },
  },

  crm: {
    search: function (id) {
      return `/api/v1/crm/customers/search/${id}`
    },
    update: function () {
      return `/api/v1/crm/customers/update`
    },
    save: function () {
      return `/api/v1/crm/customers/save`
    },
  },
}
