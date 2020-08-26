<template>
  <div v-if="isOverall">
    <v-btn @click="sendToCrm" large :block="$vuetify.breakpoint.smAndDown" color="primary">
      <v-icon small left>mdi-send</v-icon>
      {{ trans('Send Scores to CRM') }}
    </v-btn>
    <v-menu>
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" large :block="$vuetify.breakpoint.smAndDown" color="primary">
          <v-icon small>mdi-dots-horizontal</v-icon>
        </v-btn>
      </template>
      <v-list>
        <v-list-item @click="sendDocumentToCrm">
          <v-list-item-action>
            <v-icon small class="text--muted">mdi-paperclip</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="trans('Send Overall Report Document to CRM')"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item @click="sendBothDataToCrm">
          <v-list-item-action>
            <v-icon small class="text--muted">mdi-paperclip</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="trans('Send Both Scores and Report Document to CRM')"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
  <v-btn v-else @click="sendToCrm" icon>
    <v-icon small>mdi-send</v-icon>
  </v-btn>
</template>

<script>
import $api from '@/modules/Customer/routes/api'

export default {
  props: ['customer', 'user', 'type'],

  data: () => ({
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
      this.$store.dispatch('snackbar/show', { button: { show: false }, timeout: 0, text: 'Sending report to CRM. Please wait...'});

      this.getReportData().then(response => {
        this.resource.data = response.data

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

        console.log('DATA', data);

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

    sendDocumentToCrm () {
      this.getReportData().then(response => {
        this.resource.data = response.data

        let data = {
          Id: _.toUpper(this.resource.data.customer.token),
          FileContentBase64: this.resource.data['overall:report'] || 'empty',
        }

        // console.log(this.resource.data);

        this.$store.dispatch('snackbar/show', { icon: 'mdi-spin mdi-loading', button: { show: false }, timeout: 0, text: 'Sending Overall Report Document to CRM. Establishing connection to CRM...'});

        axios.post(
          $api.crm.sendDocument(), data
        ).then(response => {
          console.log('asdasd', response.data);
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
        })
      });
    },

    sendBothDataToCrm () {
      this.sendToCrm()
      this.sendDocumentToCrm()
    },
  }
}
</script>
