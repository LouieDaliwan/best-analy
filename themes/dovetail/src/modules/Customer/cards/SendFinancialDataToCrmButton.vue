<template>
  <v-btn :loading="isSending" :disabled="isSending" @click="sendBothScoreAndDocument" large :block="$vuetify.breakpoint.smAndDown" color="primary">
    <v-icon left small>mdi-send</v-icon>
    {{ trans('Send Financial Report to CRM') }}
  </v-btn>
</template>

<script>
import $api from '@/modules/Customer/routes/api'

export default {
  props: ['customer', 'user'],

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

    sendBothScoreAndDocument () {
      this.sendToCrm();
      this.sendDocumentToCrm();
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
          FileNo: this.resource.data.customer.filenumber,
          YearofFinancial: this.resource.data.customer.metadata.years.Years.Year3,
          SubmissionDate: this.resource.data.profit_and_loss['Submission Date'],
          Revenue: JSON.stringify(this.resource.data.profit_and_loss.Revenue),
          CostofGoodsSold: JSON.stringify(this.resource.data.profit_and_loss.CostOfGoodsSold),
          OtherExpenses: JSON.stringify(this.resource.data.profit_and_loss.OtherExpenses),
          NonOperatingExpenses: JSON.stringify(this.resource.data.profit_and_loss.OtherExpenses['Non-Operating expenses (NOE)'] || {}),
          OperatingLossProfit: JSON.stringify(this.resource.data.profit_and_loss.OtherExpenses['Operating (loss)/profit'] || {}),
          Depreciation: JSON.stringify(this.resource.data.profit_and_loss.OtherExpenses['Depreciation'] || {}),
          Taxes: JSON.stringify(this.resource.data.profit_and_loss.OtherExpenses['Taxes'] || {}),
          NetLossProfits: this.resource.data.profit_and_loss.NetProfit.Year3,
          FixedAssets: JSON.stringify(this.resource.data.profit_and_loss.FixedAssets['Fixed Assets']),
          TotalLiabilities: JSON.stringify(this.resource.data.profit_and_loss.FixedAssets['Total Liabilities']),
          StockholdersEquity: JSON.stringify(this.resource.data.profit_and_loss.FixedAssets["Stockholder's Equity"]),
          Marketing: JSON.stringify(this.resource.data.profit_and_loss.Marketing),
          Rent: JSON.stringify(this.resource.data.profit_and_loss.Rent),
          Salaries: JSON.stringify(this.resource.data.profit_and_loss.Salaries),
          LicensingFees: JSON.stringify(this.resource.data.profit_and_loss['Licensing Fees']),
          VisaEmploymentFees: JSON.stringify(this.resource.data.profit_and_loss['Visa / Employment Fees']),
        }

        // console.log(this.resource.data, data)

        this.$store.dispatch('snackbar/show', { icon: 'mdi-spin mdi-loading', button: { show: false }, timeout: 0, text: 'Sending report to CRM. Establishing connection to CRM...'});

        axios.post(
          $api.crm.sendFinancial(), data
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

    sendDocumentToCrm () {
      this.isSending = true;

      this.getReportData().then(response => {
        this.resource.data = response.data

        let data = {
          Id: _.toUpper(this.resource.data.customer.token),
          FileContentBase64: this.resource.data['report:financial'] || 'empty',
        }

        this.$store.dispatch('snackbar/show', { icon: 'mdi-spin mdi-loading', button: { show: false }, timeout: 0, text: 'Sending Financial Report Document to CRM. Establishing connection...'});

        axios.post(
          $api.crm.sendDocument(), data
        ).then(response => {
          console.log('data', response.data);
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
        })
      })
    },
  }
}
</script>
