<template>
  <div v-if="isOverall">
    <v-btn :loading="isSending" :disabled="isSending" @click="sendAllScoresAndDocuments" large :block="$vuetify.breakpoint.smAndDown" color="primary">
      <v-icon small left>mdi-send</v-icon>
      {{ trans('Send to CRM') }}
    </v-btn>
    <v-dialog max-width="420" v-model="dialog" persistent>
      <v-card>
        <v-list>
          <v-list-item v-for="(item, i) in checklist" :key="i" :title="item.message">
            <v-list-item-content>
              <v-list-item-title v-text="item.name"></v-list-item-title>
            </v-list-item-content>
            <v-list-item-action>
              <v-icon v-if="item.status == 'pending'" small left>mdi-checkbox-blank-circle-outline</v-icon>
              <v-progress-circular v-else-if="item.status == 'sending'" indeterminate width="2" size="12"></v-progress-circular>
              <v-icon v-else-if="item.status == 'done'" small left color="success">mdi-check</v-icon>
              <div v-else-if="item.status == 'error'">
                <v-icon small left color="error">mdi-alert-circle</v-icon>
              </div>
            </v-list-item-action>
          </v-list-item>
        </v-list>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn depressed @click="dialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
  <v-btn v-else @click="sendToCrm" icon>
    <v-icon small>mdi-send</v-icon>
  </v-btn>
</template>

<script>
import $api from '@/modules/Customer/routes/api'

export default {
  props: ['customer', 'user', 'type', 'month'],

  data: () => ({
    isSending: false,
    sendAll: false,
    checklist: [
      { message: '', name: trans('Sending Overall Scores'), icon: 'mdi-cube-send', status: 'pending' },
      { message: '', name: trans('Sending Overall Document'), icon: 'mdi-file-send', status: 'pending' },
      // { message: '', name: trans('Sending Financial Scores'), icon: 'mdi-cube-send', status: 'pending' },
      // { message: '', name: trans('Sending Financial Document'), icon: 'mdi-file-send', status: 'pending' },
    ],
    dialog: false,
    sendBothScoresAndFile: false,
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
    sendAllScoresAndDocuments () {
      this.dialog = true;
      this.sendAll = true;

      this.checklist = this.checklist.map((item) => {
        return Object.assign(item, {status: 'pending', message: ''});
      });

      this.sendToCrm();
      // this.sendFinancialScores();
    },

    getReportData () {
      return new Promise((resolve, reject) => {
        let customer = this.customer
        let user = this.user
        var month = this.month

        axios.get(
          `/api/v1/reports/overall/customer/${customer}/user/${user}?month=${month}`
        ).then(response => {
          resolve(response)
        }).catch(err => {
          reject(err)
        })
      })
    },

    getElements () {
      console.log(this.resource.data)
      let report = this.resource.data.report.value || {}
      let _elements = {}

      if (this.isOverall) {
        let elements = _.map(report.indices, function (v, k) {
          return v.elements
        })

        for (var i = elements.length - 1; i >= 0; i--) {
          let c = elements[i]

          _elements = Object.assign(_elements, c, {
            OverallScore: report['overall:score'] * 100,
            SustainabilityOverallScore: report.indices.BSPI['overall:total']/100,
            FinancialOverallScore: report.indices.FMPI['overall:total']/100,
            ProductivityOverallScore: report.indices.PMPI['overall:total']/100,
            HROverallScore: report.indices.HRPI['overall:total']/100,
          })
        }

      } else {
        _elements = report['current:index'].elements;
      }

      _elements = _.mapKeys(_elements, function (v, k) { return k.replace(/[^a-zA-Z]/g, ''); });
      _elements = _.mapKeys(_elements, function (v, k) { return k.replace(/\s+/g, ''); });

      _elements = _.mapValues(_elements, function (v, k) { return v * 100; });

      _elements['EmployeeEngagement'] = _elements['EmployeeEngagementCommunication'] || 0;
      _elements['CareerManagement'] = _elements['CareerTalentManagement'] || 0;

      let d = report['overall:enablers']['chart'].data
      let l = report['overall:enablers']['chart'].label

      for (var i = d.length - 1; i >= 0; i--) {
        let c = d[i]
        _elements[l[i]] = c || 0;
      }

      // _elements['Documentation'] = report['overall:enablers']['enablers']['Documentation'] || '';
      // _elements['Talent'] = report['overall:enablers']['enablers']['Talent'] || '';
      // _elements['Technology'] = report['overall:enablers']['enablers']['Technology'] || '';
      _elements['WorkflowProcesses'] = _elements['Workflow Processess'] || '';


      return _elements;
    },

    getOverallScore () {
      let score = this.resource.data.report.value['current:index']['overall:total'];
      let pindex = this.resource.data.report.value['current:index'];
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
      this.isSending = true;
      this.checklist[0].status = 'sending';

      this.$store.dispatch('snackbar/show', { button: { show: false }, timeout: 0, text: 'Sending report to CRM. Please wait...'});

      this.getReportData().then(response => {
        this.resource.data = response.data

        console.log(response.data);
        if (! this.resource.data.customer) {
          this.$store.dispatch('snackbar/show', { text: 'No report data found.'});

          return false;
        }

        let data = Object.assign(this.getOverallScore(), this.getElements(), {
          Id: _.toUpper(this.resource.data.customer.token),
          FileNo: this.resource.data.customer.filenumber,
          Status: 100000006,
          OverallScore: this.resource.data.report.value['overall:score'] * 100 || null,
          // FileContentBase64: this.resource.data.report.fileContentBase64,
          Comments: this.resource.data['overall:comment'] || 'No comment',
          OverallComment: this.resource.data.report.value['overall:comment'] || null,
          'Lessons Learnt': this.resource.data.report.value['overall:comment'] || null,
        })

        this.$store.dispatch('snackbar/show', { icon: 'mdi-spin mdi-loading', button: { show: false }, timeout: 0, text: 'Sending report to CRM. Establishing connection to CRM...'});

        console.log('Sending overall scores...', data);

        axios.post(
          `/api/v1/crm/customers/save`, data
        ).then(response => {
          this.$store.dispatch('snackbar/hide')
          this.checklist[0].status = 'done';

          if (response.data.Code == 1) {
            this.$store.dispatch('snackbar/show', { icon: false, timeout: 8000, button: {show: true}, text: trans('Successfully sent to CRM')})
          } else {
            this.checklist[0].status = 'error';
            this.checklist[0].message = response.data.Message;
            // this.$store.dispatch('dialog/error', {
            //   show: true,
            //   width: 400,
            //   buttons: { cancel: { show: false } },
            //   title: 'Returned a Code ' + response.data.Code,
            //   text: response.data.Message,
            // })
          }

          if (this.sendBothScoresAndFile) {
            // this.sendDocumentToCrm();
          }
        }).catch(err => {
          this.checklist[0].status = 'error';
          this.$store.dispatch('snackbar/show', { icon: false, timeout: 8000, button: {show: true}, text: trans('Unable to connect to CRM. Please check your network connection')})
        }).finally(() => {
          this.isSending = false;

          if (this.sendAll) {
            this.sendDocumentToCrm();
          }
        })
      }).catch(err => {
        console.log('err', err)
      })
    },

    sendDocumentToCrm () {
      this.isSending = true;
      this.checklist[1].status = 'sending';

      this.getReportData().then(response => {
        this.resource.data = response.data

        let data = {
          Id: _.toUpper(this.resource.data.customer.token),
          FileName: "Overall Scores",
          FileContentBase64: this.resource.data['overall:report'] || 'empty',
        }

        console.log('Sending overall document...', data);

        this.$store.dispatch('snackbar/show', { icon: 'mdi-spin mdi-loading', button: { show: false }, timeout: 0, text: 'Sending Overall Report Document to CRM. Establishing connection to CRM...'});

        axios.post(
          $api.crm.sendDocument(), data
        ).then(response => {
          this.$store.dispatch('snackbar/hide')
          this.checklist[1].status = 'done';

          if (response.data.Code == 1) {
            this.$store.dispatch('snackbar/show', { icon: false, timeout: 8000, button: {show: true}, text: trans('File Successfully sent to CRM')})
          } else {
            this.checklist[1].status = 'error';
            this.checklist[1].message = response.data.Message;
            // this.$store.dispatch('dialog/error', {
            //   show: true,
            //   width: 400,
            //   buttons: { cancel: { show: false } },
            //   title: 'Returned a Code ' + response.data.Code,
            //   text: response.data.Message,
            // })
          }
        }).catch(err => {
          this.checklist[1].status = 'error';
          this.$store.dispatch('snackbar/show', { icon: false, timeout: 8000, button: {show: true}, text: trans('Unable to connect to CRM. Please check your network connection')})
        }).finally(() => {
          this.isSending = false;

          // if (this.sendAll) {
          //   this.sendFinancialScores();
          // }
        })
      });
    },

    sendBothDataToCrm () {
      this.sendBothScoresAndFile = true
      this.sendToCrm()
    },

    sendFinancialScores () {
      this.checklist[2].status = 'sending';
      this.$store.dispatch('snackbar/show', { button: { show: false }, timeout: 0, text: 'Sending report to CRM. Please wait...'});

      this.getReportData().then(response => {
        this.resource.data = response.data
        console.log(this.resource.data)

        if (! this.resource.data.customer) {
          this.$store.dispatch('snackbar/show', { text: 'No report data found.'});

          return false;
        }

        // let data = {
        //   FileNo: this.resource.data.customer.filenumber,
        //   YearofFinancial: this.resource.data.customer.metadata ? this.resource.data.customer.metadata.years.Years.Year3 : 'No year was set',
        //   SubmissionDate: this.resource.data.profit_and_loss['Submission Date'],
        //   Revenue: JSON.stringify(this.resource.data.profit_and_loss.Revenue),
        //   CostofGoodsSold: JSON.stringify(this.resource.data.profit_and_loss.CostOfGoodsSold),
        //   OtherExpenses: JSON.stringify(this.resource.data.profit_and_loss.OtherExpenses),
        //   NonOperatingExpenses: JSON.stringify(this.resource.data.profit_and_loss.OtherExpenses['Non-Operating expenses (NOE)'] || {}),
        //   OperatingLossProfit: JSON.stringify(this.resource.data.profit_and_loss.OtherExpenses['Operating (loss)/profit'] || {}),
        //   Depreciation: JSON.stringify(this.resource.data.profit_and_loss.OtherExpenses['Depreciation'] || {}),
        //   Taxes: JSON.stringify(this.resource.data.profit_and_loss.OtherExpenses['Taxes'] || {}),
        //   NetLossProfits: this.resource.data.profit_and_loss.NetProfit.Year3,
        //   FixedAssets: JSON.stringify(this.resource.data.profit_and_loss.FixedAssets['Fixed Assets']),
        //   TotalLiabilities: JSON.stringify(this.resource.data.profit_and_loss.FixedAssets['Total Liabilities']),
        //   StockholdersEquity: JSON.stringify(this.resource.data.profit_and_loss.FixedAssets["Stockholder's Equity"]),
        //   Marketing: JSON.stringify(this.resource.data.profit_and_loss.Marketing),
        //   Rent: JSON.stringify(this.resource.data.profit_and_loss.Rent),
        //   Salaries: JSON.stringify(this.resource.data.profit_and_loss.Salaries),
        //   LicensingFees: JSON.stringify(this.resource.data.profit_and_loss['Licensing Fees']),
        //   VisaEmploymentFees: JSON.stringify(this.resource.data.profit_and_loss['Visa / Employment Fees']),
        // }


        let data = {
          FileNo: this.resource.data.customer.filenumber,
          YearofFinancial: this.resource.data.customer.metadata ? this.resource.data.customer.metadata.years.Years.Year3 : 'No year was set',
          SubmissionDate: this.resource.data.profit_and_loss['Submission Date'] || this.resource.data.report.updated_at,
          Revenue: parseInt(this.resource.data.profit_and_loss.Revenue.Year3 || 0),
          CostofGoodsSold: parseInt(this.resource.data.profit_and_loss.CostOfGoodsSold.Year3 || 0),
          OtherExpenses: parseInt(this.resource.data.profit_and_loss.OtherExpenses.Year3 || 0),
          NonOperatingExpenses: parseInt(this.resource.data.profit_and_loss.OtherExpenses['Non-Operating expenses (NOE)'].Year3 || 0),
          OperatingLossProfit: parseInt(this.resource.data.profit_and_loss.OtherExpenses['Operating (loss)/profit'].Year3 || 0),
          Depreciation: parseInt(this.resource.data.profit_and_loss.OtherExpenses['Depreciation'].Year3 || 0),
          Taxes: parseInt(this.resource.data.profit_and_loss.OtherExpenses['Taxes'].Year3 || 0),
          NetLossProfits: parseInt(this.resource.data.profit_and_loss.NetProfit.Year3 || 0),
          FixedAssets: parseInt(this.resource.data.profit_and_loss.FixedAssets['Fixed Assets'].Year3 || 0),
          TotalLiabilities: parseInt(this.resource.data.profit_and_loss.FixedAssets['Total Liabilities'].Year3 || 0),
          StockholdersEquity: parseInt(this.resource.data.profit_and_loss.FixedAssets["Stockholders' Equity"].Year3 || 0),
          Marketing: parseInt(this.resource.data.profit_and_loss.Marketing.Year3 || 0),
          Rent: parseInt(this.resource.data.profit_and_loss.Rent.Year3 || 0),
          Salaries: parseInt(this.resource.data.profit_and_loss.Salaries.Year3 || 0),
          LicensingFees: parseInt(this.resource.data.profit_and_loss['Licensing Fees'].Year3 || 0),
          VisaEmploymentFees: parseInt(this.resource.data.profit_and_loss['Visa / Employment Fees'].Year3 || 0),
        }


        console.log('Sending financial scores...', data);

        this.$store.dispatch('snackbar/show', { icon: 'mdi-spin mdi-loading', button: { show: false }, timeout: 0, text: 'Sending report to CRM. Establishing connection to CRM...'});

        axios.post(
          $api.crm.sendFinancial(), data
        ).then(response => {
          this.$store.dispatch('snackbar/hide')
          this.checklist[2].status = 'done';

          if (response.data.Code == 1) {
            this.$store.dispatch('snackbar/show', { icon: false, timeout: 8000, button: {show: true}, text: trans('Successfully sent to CRM')})
          } else {
            this.checklist[2].status = 'error';
            this.checklist[2].message = response.data.Message;
            // this.$store.dispatch('dialog/error', {
            //   show: true,
            //   width: 400,
            //   buttons: { cancel: { show: false } },
            //   title: 'Returned a Code ' + response.data.Code,
            //   text: response.data.Message,
            // })
          }
        }).catch(err => {
          this.$store.dispatch('snackbar/show', { icon: false, timeout: 8000, button: {show: true}, text: trans('Unable to connect to CRM. Please check your network connection')})
          this.checklist[2].status = 'error';
        }).finally(() => {
          // if (this.sendAll) {
          //   this.sendFinancialDocument();
          // }
        })
      }).catch(err => {
        console.log('err', err)
      })
    },

    sendFinancialDocument () {
      this.checklist[3].status = 'sending';

      this.getReportData().then(response => {
        this.resource.data = response.data
        console.log(this)
        let data = {
          Id: _.toUpper(this.resource.data.customer.token),
          FileName: "Financial Ratios",
          FileContentBase64: this.resource.data['report:financial'] || 'empty',
        }

        console.log('Sending financial document...', data);

        this.$store.dispatch('snackbar/show', { icon: 'mdi-spin mdi-loading', button: { show: false }, timeout: 0, text: 'Sending Financial Report Document to CRM. Establishing connection...'});

        axios.post(
          $api.crm.sendDocument(), data
        ).then(response => {
          console.log('data', response.data);
          this.$store.dispatch('snackbar/hide')
          this.checklist[3].status = 'done';

          if (response.data.Code == 1) {
            this.$store.dispatch('snackbar/show', { icon: false, timeout: 8000, button: {show: true}, text: trans('File Successfully sent to CRM')})
          } else {
            this.checklist[3].status = 'error';
            this.checklist[3].message = response.data.Message;
            // this.$store.dispatch('dialog/error', {
            //   show: true,
            //   width: 400,
            //   buttons: { cancel: { show: false } },
            //   title: 'Returned a Code ' + response.data.Code,
            //   text: response.data.Message,
            // })
          }
        }).catch(err => {
          this.checklist[3].status = 'error';
          this.$store.dispatch('snackbar/show', { icon: false, timeout: 8000, button: {show: true}, text: trans('Unable to connect to CRM. Please check your network connection')})
        }).finally(() => {
          // this.dialog = false
        })
      })
    },
  }
}
</script>
