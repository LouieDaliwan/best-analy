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
  }
}
