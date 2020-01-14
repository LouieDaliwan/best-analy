import _get from 'lodash/get'

export default {
  name: 'trans',
  methods: {
    trans: function (string, defaultString) {
      return this.$i18n.tc(string)
    },

    __: function (string, defaultString) {
      return this.trans(string, defaultString)
    },
  }
}
