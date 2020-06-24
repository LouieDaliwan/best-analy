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
      this.getReportData().then(response => {
        this.resource.data = response.data

        if (! this.resource.data.customer) {
          this.$store.dispatch('snackbar/show', { text: 'No report data found.'});

          return false;
        }

        let data = {
          Id: this.resource.data.customer.token,
          FileNo: this.resource.data.customer.refnum,
          OverallScore: this.resource.data.report.value['overall:score'] || null,
          FileContentBase64: this.resource.data.report.fileContentBase64,
          'Lessons Learnt': this.resource.data.report.value['overall:comment'] || null,
        }

        axios.post(
          `/api/v1/crm/customers/save`, data
        ).then(response => {
          this.$store.dispatch('snackbar/show', { text: trans('Successfully sent to CRM')})
        }).catch(err => {
          this.$store.dispatch('snackbar/show', { text: trans('Unable to connect to CRM. Please check your network connection')})
        })
      }).catch(err => {
        console.log('err', err)
      })
    },
  }
}
</script>
