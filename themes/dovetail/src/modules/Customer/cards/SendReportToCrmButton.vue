<template>
  <v-btn @click="sendToCrm" icon>
    <v-icon small>mdi-send</v-icon>
  </v-btn>
</template>

<script>
export default {
  props: ['customer', 'user'],

  data: () => ({
    resource: {
      data: {}
    },
  }),

  methods: {
    getReportData () {
      return new Promise((resolve, reject) => {
        let customer = this.customer
        let user = this.user
        axios.get(
          `/api/v1/reports/overall/customer/${customer}/user/${user}`
        ).then(response => {
          resolve(response)
        }).catch(err => {
          reject(err)
        })
      })
    },

    sendToCrm () {
      this.$store.dispatch('snackbar/show', { button: { show: false }, timeout: 0, text: 'Sending report to CRM. Please wait...'});

      this.getReportData().then(response => {
        this.resource.data = response.data

        if (! this.resource.data.customer) {
          this.$store.dispatch('snackbar/show', { text: 'No report data found.'});

          return false;
        }

        let data = {
          Id: _.toUpper(this.resource.data.customer.token),
          FileNo: this.resource.data.customer.filenumber,
          Status: 100000006,
          OverallScore: this.resource.data.report.value['overall:score'] || null,
          FileContentBase64: this.resource.data.report.fileContentBase64,
          Comment: this.resource.data.report.value['overall:comment'] || null,
          'Lessons Learnt': this.resource.data.report.value['overall:comment'] || null,
        }

        console.log('xx', this.resource.data, data)

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
      }).catch(err => {
        console.log('err', err)
      })
    },
  }
}
</script>
