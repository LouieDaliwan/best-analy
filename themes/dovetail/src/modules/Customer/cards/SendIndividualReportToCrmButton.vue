<template>
  <v-btn :loading="isSending" :disabled="isSending" @click="sendDocumentToCrm" icon>
    <v-icon small>mdi-send</v-icon>
  </v-btn>
</template>

<script>
import $api from '@/modules/Customer/routes/api'

export default {
  props: ['item', 'user', 'type'],

  data: () => ({
    isSending: false,
    resource: {
      data: {}
    },
  }),

  computed: {
    isOverall () {
      return this.type == 'overall'
    },
  },

  methods: {
    // getReportData () {
    //   return new Promise((resolve, reject) => {
    //     let customer = this.item
    //     let user = this.user
    //     axios.get(
    //       `/api/v1/reports/overall/customer/${customer}/user/${user}`
    //     ).then(response => {
    //       resolve(response)
    //     }).catch(err => {
    //       reject(err)
    //     })
    //   })
    // },

    getElements () {
      let report = this.item.value || {}
      let _elements = {}

      _elements = report['current:index'].elements;

      _elements = _.mapKeys(_elements, function (v, k) { return k.replace(/[^a-zA-Z]/g, ''); });
      _elements = _.mapKeys(_elements, function (v, k) { return k.replace(/\s+/g, ''); });

      _elements = _.mapValues(_elements, function (v, k) { return v * 100; });

      return _elements;
    },

    getOverallScore () {
      let score = this.item.value['current:index']['overall:total'];
      let pindex = this.item.value['current:index'];
      let code = 'OverallScore';

      switch (pindex['pindex:code']) {
        case 'FMPI':
          code = 'Financial'+code;
          break;

        case 'PMPI':
          code = 'Productivity'+code;
          break;

        case 'HRPI':
          code = 'HR'+code;
          break;

        case 'BSPI':
          code = 'Sustainability'+code;
          break;
      }

      let o = {};
      o[code] = score;

      return o;
    },

    sendToCrm () {
      this.$store.dispatch('snackbar/show', { button: { show: false }, timeout: 0, text: 'Sending report to CRM. Please wait...'});

      if (! this.item.customer) {
        this.$store.dispatch('snackbar/show', { text: 'No report data found.'});

        return false;
      }

      // console.log('e', this.getElements());

      let data = Object.assign(this.getOverallScore(), this.getElements(), {
        Id: _.toUpper(this.item.customer.token),
        FileNo: this.item.customer.filenumber,
        Status: 100000006,
        OverallScore: (this.item.value['overall:score'] || 0) * 100,
        // FileContentBase64: this.item.fileContentBase64,
        Comments: this.item['overall:comment'] || 'No comment',
        OverallComment: this.item.value['overall:comment'] || null,
        'Lessons Learnt': this.item.value['overall:comment'] || null,
      })

      console.log('data:scores', data);

      this.$store.dispatch('snackbar/show', { icon: 'mdi-spin mdi-loading', button: { show: false }, timeout: 0, text: 'Sending report to CRM. Establishing connection to CRM...'});


      axios.post(
        `/api/v1/crm/customers/save`, data
      ).then(response => {
        this.$store.dispatch('snackbar/hide')

        if (response.data.Code == 1) {
          this.$store.dispatch('snackbar/show', { icon: false, timeout: 8000, button: {show: true}, text: trans('Successfully sent to CRM')})
        } else {
          this.$store.dispatch('dialog/error', {
            show: true,
            width: 400,
            buttons: { cancel: { show: false } },
            title: 'Returned a Code ' + response.data.Code,
            text: response.data.Message,
          })
        }
      }).catch(err => {
        this.$store.dispatch('snackbar/show', { icon: false, timeout: 8000, button: {show: true}, text: trans('Unable to connect to CRM. Please check your network connection')})
      })
    },

    sendDocumentToCrm () {
      this.isSending = true;

      let data = {
        Id: _.toUpper(this.item.customer.token),
        FileContentBase64: this.item.fileContentBase64,
      }

      this.$store.dispatch('snackbar/show', { icon: 'mdi-spin mdi-loading', button: { show: false }, timeout: 0, text: 'Sending Overall Report Document to CRM. Establishing connection to CRM...'});

      axios.post(
        $api.crm.sendDocument(), data
      ).then(response => {
        this.$store.dispatch('snackbar/hide')

        if (response.data.Code == 1) {
          this.$store.dispatch('snackbar/show', { icon: false, timeout: 8000, button: {show: true}, text: trans('File Successfully sent to CRM')})
        } else {
          this.$store.dispatch('dialog/error', {
            show: true,
            width: 400,
            buttons: { cancel: { show: false } },
            title: 'Returned a Code ' + response.data.Code,
            text: response.data.Message,
          })
        }
      }).catch(err => {
        this.$store.dispatch('snackbar/show', { icon: false, timeout: 8000, button: {show: true}, text: trans('Unable to connect to CRM. Please check your network connection')})
      }).finally(() => {
        this.isSending = false;
      });
    },

    sendBothDataToCrm () {
      this.sendToCrm()
      this.sendDocumentToCrm()
    },
  }
}
</script>
