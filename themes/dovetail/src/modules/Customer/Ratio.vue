<template>
  <admin>
    <metatag :title="trans('Find Company')"></metatag>

    <page-header :back="{ to: {name: 'companies.reports'}, text: trans('Back to Reports') }">
      <template v-slot:utilities>
        <a v-if="resource.data.report" class="dt-link text--decoration-none mr-4" @click.prevent="previewPDFOverallReport(resource.data.report)">
          <v-icon small left>mdi-file-pdf</v-icon>
          {{ trans('Preview PDF Report') }}
        </a>
        <a class="dt-link text--decoration-none mr-4" @click="sendToCrm(item)">
          <v-icon small left>mdi-send</v-icon>
          {{ trans('Send Report to CRM') }}
        </a>
      </template>

      <template v-slot:action>
        <v-btn v-if="resource.lang == 'en'" :block="$vuetify.breakpoint.smAndDown" large color="primary" @click="goToShowPage('ar')">
          <v-icon small left>mdi-earth</v-icon>
          {{ trans('View Report in Arabic') }}
        </v-btn>
        <v-btn v-else :block="$vuetify.breakpoint.smAndDown" large color="primary" @click="goToShowPage('en')">
          <v-icon small left>mdi-earth</v-icon>
          {{ trans('View Report in English') }}
        </v-btn>
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

export default {
  data: () => ({
    resource: {
      lang: window.localStorage.getItem('report:lang') || 'en',
      loading: false,
      data: {},
    },
    url: null,
  }),

  methods: {
    getReportData () {
      let customer = this.$route.params.id
      let user = this.$route.query.user_id || $auth.getId()
      axios.get(
        `/api/v1/reports/overall/customer/${customer}/user/${user}`
      ).then(response => {
        this.resource.data = response.data
      })
    },

    getReport () {
      let id = this.$route.query.user_id || $auth.getId()
      let customerId = this.$route.params.id
      let lang = this.$route.query.lang || this.resource.lang
      let query = Object.assign({}, this.$route.query, { lang: lang})
      this.$router.replace({query}).catch(err => {})
      this.url = `/best/preview/reports/ratios?user_id=${id}&customer_id=${customerId}&lang=${lang}`
    },

    previewPDFOverallReport (item) {
      let lang = this.$route.query.lang || this.resource.lang
      window.open(`/best/reports/pdf/preview?report_id=${item.id}&type=financialratio&lang=${lang}`, '_blank')
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
      // axios.get(
      //   `/api/v1/reports/${this.$route.params.report}/download`
      // ).then(response => {
      //   let blob = new Blob([response.data], { type: 'application/pdf' })
      //   let link = document.createElement('a')
      //   link.href = window.URL.createObjectURL(blob)
      //   link.download = `Report.pdf`
      //   link.click()
      // })
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
        name: 'reports.ratios',
        params: {
          id: this.$route.params.id,
          report: this.$route.params.report
        },
        query: {
          lang: lang,
          type: 'ratios',
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
