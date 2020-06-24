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

  overall: function (customer, user) {
    return `/api/v1/reports/overall/customer/${customer}/user/${user}`
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

  reports: {
    list: function (id) {
      return `/api/v1/customers/${id}/reports`
    },
    generate: function (id) {
      return `/api/v1/reports/${id}/generate`
    },
    download: function (id) {
      return `/api/v1/reports/${id}/download`
    },
    delete: function (id) {
      return `/api/v1/reports/${id}`
    }
  },
}
