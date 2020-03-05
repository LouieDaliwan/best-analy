<template>
  <admin>
    <metatag :title="trans('Find Company')"></metatag>

    <page-header :back="{ to: {name: 'companies.reports'}, text: trans('Back to Reports') }">
      <template v-slot:title>{{ trans('Report Preview') }}</template>
      <template v-slot:utilities>
        <!-- <a href="#" @click.prevent="downloadReport" class="dt-link text--decoration-none mr-4">{{ trans('Download Report') }}</a> -->
        <a href="#" @click.prevent="goToSurveyPage(resource.data)" class="dt-link text--decoration-none mr-4"><v-icon left>mdi-search</v-icon>{{ trans('View Survey') }}</a>
      </template>
    </page-header>

    <template v-if="resource.loading">
      <skeleton-show></skeleton-show>
    </template>

    <template v-else>
      <v-card outlined>
        <iframe width="100%" id="iframe-preview" :src="url" frameborder="0"></iframe>
      </v-card>
    </template>
  </admin>
</template>

<script>
  export default {
    data: () => ({
      resource: {
        loading: false,
        data: {},
      },
      url: null,
    }),

    methods: {
      getReport () {
        axios.get(
          `/api/v1/reports/${this.$route.params.report}`
        ).then(response => {
          this.resource.data = response.data.data
          let id = this.resource.data.value['current:index']['taxonomy']['id'] || null
          let type = this.$route.query.type || 'index'
          this.url = `/best/preview/reports/${this.$route.params.report}?type=${type}&taxonomy_id=${id}`
        })
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
      }
    },

    mounted () {
      this.setIframeHeight()
      this.getReport()
    },
  }
</script>
