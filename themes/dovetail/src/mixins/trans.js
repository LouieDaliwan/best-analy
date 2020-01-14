import _get from 'lodash/get'

export default {
  name: 'trans',
  methods: {
    trans: function (string, defaultString) {
      return this.$tc(string, defaultString)
    },

    __: function (string, defaultString) {
      return this.trans(string, defaultString)
    },
  }
}
