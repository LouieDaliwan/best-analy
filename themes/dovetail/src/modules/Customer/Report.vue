<template>
  <admin>
    <metatag :title="trans('Find Company')"></metatag>

    <page-header :back="{ to: {name: 'companies.reports'}, text: trans('Back to Reports') }">
      <template v-slot:title>{{ trans('Report Preview') }}</template>
      <template v-slot:utilities>
        <a v-if="resource.data" class="dt-link text--decoration-none mr-4" @click.prevent="previewPDFReport(resource.data)">
          <v-icon small left>mdi-file-pdf</v-icon>
          {{ trans('Preview PDF Report') }}
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

    <!-- <template v-if="isFetchingResource">
      <skeleton-show></skeleton-show>
    </template> -->

    <template v-show="isFinishedFetchingResource">
      <v-card outlined>
        <iframe width="100%" id="iframe-preview" :src="url" frameborder="0"></iframe>
      </v-card>
    </template>
  </admin>
</template>

<script>
import $auth from '@/core/Auth/auth'
import SkeletonShow from './cards/SkeletonShow'

export default {
  computed: {
    isFetchingResource () {
      return this.resource.loading
    },
    isFinishedFetchingResource () {
      return !this.resource.loading
    },
  },

  components: {
    SkeletonShow
  },

  data: () => ({
    resource: {
      lang: window.localStorage.getItem('report:lang') || 'en',
      loading: false,
      file: {},
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
        this.resource.file = response.data
      })
    },

    previewPDFReport (item) {
      let lang = this.$route.query.lang || this.resource.lang
      window.open(
        `/best/reports/pdf/preview?report_id=${item.id}&month=${item.remarks}&lang=${lang}`,
        '_blank'
      )
    },

    getReport () {
      this.resource.loading = true
      let lang = this.$route.query.lang || this.resource.lang
      this.$router.push({ query: { lang: lang }}).catch(err => {})
      axios.get(
        `/api/v1/reports/${this.$route.params.report}`, {
          params: { lang: lang }
        }
      ).then(response => {
        this.resource.data = response.data.data
        let id = this.resource.data.value['current:index']['taxonomy']['id'] || null
        let type = this.$route.query.type || 'index'
        this.url = `/best/preview/reports/${this.$route.params.report}?type=${type}&taxonomy_id=${id}&lang=${lang}`
      }).finally(() => { this.resource.loading = false })
    },

    goToSurveyPage (item) {
      this.$router.push({
        name: 'companies.response',
        query: { month: item.remarks },
        params: {
          id: this.$route.params.id,
          taxonomy: item.value['current:index']['taxonomy']['id'] || null,
          survey: item.value['survey:id'],
        },
      })
    },

    goToShowPage (lang = 'en') {
      window.localStorage.setItem('report:lang', lang)
      this.resource.lang = lang
      this.$router.push({
        name: 'reports.show',
        params: {
          id: this.$route.params.id,
          report: this.$route.params.report
        },
        query: {
          lang: lang,
        }
      }).catch(err => {})
      this.$router.go()
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
      document.querySelector('#iframe-preview').addEventListener('load', function (e) {
        var iframe = this
        var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow

        if (iframeWin.document.body) {
          iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight
        }
      })
    }
  },

  mounted () {
    this.setIframeHeight()
    this.getReportData()
    this.getReport()
  },
}
</script>
