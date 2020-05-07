export default {
  list: function () {
    return '/api/v1/teams'
  },

  store: function () {
    return '/api/v1/teams'
  },

  delete: function (id = null) {
    return `/api/v1/teams/delete/${id}`
  },

  trashed: function () {
    return '/api/v1/teams/trashed'
  },

  owned: function () {
    return '/api/v1/teams/owned'
  },

  restore: function (id = null) {
    return `/api/v1/teams/restore/${id}`
  },

  show: function (id = null) {
    return `/api/v1/teams/${id}`
  },

  update: function (id = null) {
    return `/api/v1/teams/${id}`
  },

  destroy: function (id = null) {
    return `/api/v1/teams/${id}`
  },

  users: {
    list: function () {
      return '/api/v1/users'
    },
  },

  customers: {
    show: function (customer) {
      return `/api/v1/customers/${customer}`
    }
  },

  reports: {
    users: {
      list : function (customer, user) {
        return `/api/v1/reports/customer/${customer}/user/${user}`
      },

      show: function (user) {
        return `/api/v1/users/${user}`
      },
    },

    delete: function (id) {
      return `/api/v1/reports/${id}`
    }
  }
}
