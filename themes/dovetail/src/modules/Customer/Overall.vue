<template>
  <admin>
    <metatag :title="trans('Overall Report')"></metatag>

    <page-header :back="{ to: {name: 'companies.reports'}, text: trans('Back to Reports') }">
      <template v-slot:utilities>
        <div class="mb-2">
          <a v-if="resource.data.report" class="dt-link text--decoration-none mr-4" @click.prevent="previewPDFOverallReport(resource.data.report)">
            <v-icon small left>mdi-file-pdf</v-icon>
            {{ trans('Preview PDF Report') }}
          </a>
        </div>
        <can code="reports.comment">
          <add-overall-comment :month.sync="resource.data.report.month"></add-overall-comment>
        </can>
      </template>

      <template v-slot:action>
        <a v-if="resource.lang == 'en'" class="dt-link text--decoration-none mr-4" @click="goToShowPage('ar')">
          <v-icon small left>mdi-earth</v-icon>
          {{ trans('View Report in Arabic') }}
        </a>
        <a v-else class="dt-link text--decoration-none mr-4" @click="goToShowPage('en')">
          <v-icon small left>mdi-earth</v-icon>
          {{ trans('View Report in English') }}
        </a>
        <div class="mb-3">
          <div v-if="resource.data.customer && isInEnglish">
            <send-report-to-crm-button
              type="overall"
              with-file
              with-financials
              class="mt-4"
              :customer="resource.data.customer.id"
              :user="resource.data.report.user_id"
              :month="resource.data.report.month"
            ></send-report-to-crm-button>

          <!-- 
            <send-financial-data-to-crm-button
              v-if="resource.data.customer.is_fs_has_no_zero_value && isInEnglish"
              class="mt-4"
              :customer="resource.data.customer.id"
              :user="resource.data.report.user_id"
            ></send-financial-data-to-crm-button> -->
          </div>
        </div>
      </template>
    </page-header>

    <!-- <template v-if="resource.loading">
      <skeleton-show></skeleton-show>
    </template> -->

    <template>
      <v-card outlined>
        <iframe width="100%" id="iframe-preview" :src="url" frameborder="0"></iframe>
      </v-card>
    </template>
  </admin>
</template>

<script>
import $auth from '@/core/Auth/auth'
import $api from './routes/api'
import SendReportToCrmButton from '@/modules/Customer/cards/SendReportToCrmButton.vue'
import SendFinancialDataToCrmButton from '@/modules/Customer/cards/SendFinancialDataToCrmButton.vue';

export default {
  components: {
    SendReportToCrmButton,
    SendFinancialDataToCrmButton,
  },

  computed: {
    isInEnglish () {
      return this.resource.lang == 'en';
    },
  },

  data: () => ({
    api: $api,

    resource: {
      lang: window.localStorage.getItem('report:lang') || 'en',
      loading: false,
      data: {
        report: {
          month: '',
        },
      },
    },

    url: null,
  }),

  methods: {
    getReportData () {

      let customer = this.$route.params.id
      let user = this.$route.query.user_id || $auth.getId()

      if(typeof  this.$route.query.month === "undefined" ) {
        var month = null;
      } else {
        var month = this.$route.query.month;
      }
      axios.get($api.overall(customer, user, month)).then(response => {
        this.resource.data = response.data
      })
    },

    getReport () {
      let id = this.$route.query.user_id || $auth.getId()
      let customerId = this.$route.params.id
      let lang = this.$route.query.lang || this.resource.lang
      let query = Object.assign({}, this.$route.query, { lang: lang})

      if(typeof  this.$route.query.month === "undefined" ){
         var month = null;
      } else {
         var month = this.$route.query.month;
      }

      this.$router.replace({query}).catch(err => {})
      this.url = `/best/preview/reports/overall?user_id=${id}&customer_id=${customerId}&month=${month}&lang=${lang}`
    },

    previewPDFOverallReport (item) {
      let lang = this.$route.query.lang || this.resource.lang

      if(typeof  this.$route.query.month === "undefined" ){
         var month = null;
      } else {
         var month = this.$route.query.month;
      }

      window.open(
        `/best/reports/pdf/preview/overall?user=${item.user_id}&customer=${item.customer_id}&month=${month}&lang=${lang}`,
        '_blank'
      )
    },

    sendToCrm (item) {
      let data = {
        Id: this.resource.data.token,
        FileNo: this.resource.data.refnum,
        OverallScore: item.value['overall:score'],
        FileContentBase64: item.fileContentBase64,
        'Lessons Learnt': item.value['overall:comment'],
      }
      axios.post(
        $api.crm.save(), data
      ).then(response => {
        console.log(response)
      })
    },

    downloadReport () {
      window.location.href = `/reports/${this.$route.params.report}/download`
    },

    setIframeHeight () {
      this.resource.loading = true
      document.querySelector('iframe').addEventListener('load', function (e) {
        var iframe = this
        var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow

        if (iframeWin.document.body) {
          iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight
        }
      })
      this.resource.loading = false
    },

    goToShowPage (lang = 'en') {
      window.localStorage.setItem('report:lang', lang)
      this.resource.lang = lang
      this.$router.push({
        name: 'reports.overall',
        params: {
          id: this.$route.params.id,
          report: this.$route.params.report
        },
        query: {
          lang: lang,
          type: 'overall',
        }
      }).catch(err => {})
      this.$router.go()
    },
  },

  mounted () {
    this.setIframeHeight()
    this.getReportData()
    this.getReport()
  },
}
</script>
