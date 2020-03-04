<template>
  <v-menu open-on-hover offset-y bottom transition="slide-y-transition">
    <template v-slot:activator="{ on }">
      <v-btn :block="$vuetify.breakpoint.smAndDown" v-on="on" large color="primary">
        <v-icon small left>mdi-download</v-icon>
        {{ trans('Preview latest Report') }}
      </v-btn>
    </template>
    <v-list dense>
      <template>
        <v-list-item
          :disabled="!resource['is:finished']"
          v-for="(resource, i) in items" :key="i"
          @click="exportReport(resource)"
          >
          <v-list-item-content>
            <v-list-item-title v-text="resource.name"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item :disabled="resourcesAreNotYetFinished" @click="exportOverall()">
          <v-list-item-content>
            <v-list-item-title>{{ trans('Overall Reports') }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </template>
    </v-list>
  </v-menu>
</template>

<script>
import $api from '@/modules/Customer/routes/api'
import { mapActions } from 'vuex'

export default {
  props: ['items'],

  computed: {
    resourcesAreNotYetFinished () {
      return this.items.filter(function (item) {
        return item['is:finished']
      }).length !== this.items.length
    },
  },

  methods: {
    ...mapActions({
      showDialog: 'dialog/show',
      hideDialog: 'dialog/hide',
    }),

    getDialogOptions (options = {}) {
      return Object.assign({
        illustration: () => import('@/components/Icons/AnalysisIcon.vue'),
        title: trans('Generating :name Report', {name: options.data.name}),
        text: ['<i class="mdi mdi-spin mdi-loading mr-3"></i> Retrieving performance index submission...'],
        persistent: true,
        color: 'primary',
        buttons: {
          cancel: { show: false },
          action: { show: false },
        },
      }, options)
    },

    exportOverall () {
      this.showDialog(this.getDialogOptions({data: {name: 'Overall'}}))

      let data = {
        customer_id: this.$route.params.id,
      }

      axios.post(
        `/api/v1/reports/1/generate`, data
      ).then(response => {
        this.showDialog(this.getDialogOptions({
          data: index,
          text: ['<i class="mdi mdi-spin mdi-loading mr-3"></i> Crunching survey data...'],
        }))

        this.serveOverallFileToBrowser(response.data, index)
      })
    },

    exportReport (index) {
      // this.showDialog(this.getDialogOptions({data: index}))

      let data = {
        customer_id: this.$route.params.id,
        taxonomy_id: index.id,
      }

      axios.post(
        $api.reports.generate(index.survey.id), data
      ).then(response => {
        // this.showDialog(this.getDialogOptions({
        //   data: index,
        //   text: ['<i class="mdi mdi-spin mdi-loading mr-3"></i> Crunching survey data...'],
        // }))

        console.log(response)

        // this.serveFileToBrowser(response.data, index)
      })
    },

    serveFileToBrowser (data, index) {
      data = Object.assign(data, {pcode: index.alias})

      axios.post(
        `/reports/download`, data, {
          responseType: 'arraybuffer',
        }
      ).then(response => {
        let blob = new Blob([response.data], { type: 'application/pdf' })
        let link = document.createElement('a')
        link.href = window.URL.createObjectURL(blob)
        link.download = `${index.name} Report.pdf`
        link.click()

        this.hideDialog()
      })
    },

    serveOverallFileToBrowser (data) {
      data = Object.assign(data)

      axios.post(
        `/reports/download`, data, {
          responseType: 'arraybuffer',
        }
      ).then(response => {
        console.log(response)
        return
        let blob = new Blob([response.data], { type: 'application/pdf' })
        let link = document.createElement('a')
        link.href = window.URL.createObjectURL(blob)
        link.download = `Overall Report.pdf`
        link.click()

        this.hideDialog()
      })
    },
  },
}
</script>
