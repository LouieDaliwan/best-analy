<template>
  <admin>
    <metatag :title="resource.data.name"></metatag>

    <template v-if="resource.loading">
      <skeleton-show></skeleton-show>
    </template>

    <template v-else>
      <page-header :back="{ to: { name: 'companies.index' }, text: trans('Companies') }">
        <template v-slot:title>
          <span :class="$vuetify.breakpoint.smAndUp ? '' : 'title font-weight-bold'" class="mb-3">{{ resource.data.name }}</span>
        </template>

        <template v-slot:action>
          <!-- Export button -->
          <!-- <export-report-button :items="resource.data.indices"></export-report-button> -->
          <!-- Export button -->

          <!-- List of All Reports button -->
          <v-btn
            :block="$vuetify.breakpoint.smAndDown"
            :to="{name: 'companies.reports', params: { id: $route.params.id }}"
            color="primary"
            exact
            large
            v-if="resourcesHasReport"
            >
            <v-icon small left>mdi-file-chart-outline</v-icon>
            {{ __('View Reports') }}
          </v-btn>
          <!-- List of All Reports button -->
        </template>
      </page-header>

      <div v-show="resourcesIsNotEmpty">
        <div class="mb-6">
          <v-row>
            <v-col cols="4" md="2" class="py-0"><p class="mb-0 font-weight-bold">{{ trans('Staff Strength') }}:</p></v-col>
            <v-col cols="auto" class="py-0"><p class="mb-0 font-weight-regular"> {{ resource.data.metadata && resource.data.metadata['staffstrength'] || null }}</p></v-col>
          </v-row>
          <v-row>
            <v-col cols="4" md="2" class="py-0"><p class="mb-0 font-weight-bold">{{ trans('Industry') }}:</p></v-col>
            <v-col cols="auto" class="py-0"><p class="mb-0 font-weight-regular"> {{ resource.data.metadata && resource.data.metadata['industry'] || null }}</p></v-col>
          </v-row>
        </div>
        <p class="font-weight-regular">
          {{ trans('Please select the type of survey evaluation that you would like to do for :name', {name: resource.data.name}) }}:
        </p>
        <v-row>
          <v-col cols="12" md="6" v-for="(resource, i) in resource.data.indices || []" :key="i">
            <v-card
              :hover="$vuetify.breakpoint.smAndUp"
              :to="$vuetify.breakpoint.smAndUp ? goToCompanySurveyPage(resource) : null"
              class="card-carded"
              exact
              height="100%"
              v-ripple="$vuetify.breakpoint.smAndUp ? { class: 'primary--text' } : null"
              >
              <v-card-text>
                <!-- if report is generated -->
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <div v-if="resource['is:finished']" v-on="on" style="position: absolute;">
                      <v-icon color="success">mdi-check-circle</v-icon>
                    </div>
                  </template>
                  <span>{{ trans('You can now export the report') }}</span>
                </v-tooltip>
                <!-- if report is generated -->

                <v-row justify="space-between" align="center">
                  <v-col>
                    <h3 class="mt-5 font-weight-bold text-uppercase mb-2 mt-2 text-md-left text-center" v-text="resource.name"></h3>
                    <h4 class="text-uppercase muted--text mb-0 text-md-left text-center" v-text="('Performance Index')"></h4>
                  </v-col>
                  <v-col class="text-md-right text-center">
                    <img height="80" :src="resource.icon" :alt="resource.name">
                  </v-col>
                </v-row>
              </v-card-text>
              <v-card-actions v-if="$vuetify.breakpoint.xsOnly">
                <v-spacer></v-spacer>
                <v-btn block large text color="primary" :to="goToCompanySurveyPage(resource)" exact>{{ __('Start Survey') }}</v-btn>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </div>

      <!-- Empty state -->
      <div v-if="resourcesIsEmpty">
        <empty-state>
          <template v-slot:actions>
            <v-btn
              large
              color="primary"
              exact
              :to="{name: 'indices.create'}">
              <v-icon small left>mdi-account-plus-outline</v-icon>
              {{ trans('Add Index') }}
            </v-btn>
          </template>
        </empty-state>
      </div>
      <!-- Empty state -->
    </template>
  </admin>
</template>

<script>
import $api from './routes/api'
import Survey from '@/modules/Survey/Models/Survey'
import SkeletonShow from './cards/SkeletonShow'
import ExportReportButton from './cards/ExportReportButton'

export default {
  components: {
    ExportReportButton,
    SkeletonShow
  },

  computed: {
    resourcesIsNotEmpty () {
      return !this.resourcesIsEmpty
    },

    resourcesIsEmpty () {
      return window._.isEmpty(this.resource.data) && !this.resource.loading
    },

    resourcesHasReport () {
      console.log(this.resource.data.indices.filter((i) => (i['is:finished'])).length)
      return this.resource.data.indices.filter((i) => (i['is:finished'])).length >= 1
    }
  },

  data: () => ({
    api: $api,

    resource: new Survey,

    resources: {
      data: [],
      gradients: [
        'linear-gradient(to top, #cc208e 0%, #6713d2 100%)',
        'linear-gradient(to top, #ff0844 0%, #ffb199 100%)',
        'linear-gradient(0deg, #53b8dc 0%, #7aefb9 100%)',
        'linear-gradient(to top, #00c6fb 0%, #005bea 100%)'
      ]
    }
  }),

  methods: {
    getResource () {
      this.resource.loading = true
      axios.get(
        $api.show(this.$route.params.id)
      ).then(response => {
        this.resource.data = response.data.data
      }).finally(() => { this.resource.loading = false })
    },

    goToCompanySurveyPage (index) {
      const company = this.$route.params.id
      return {
        name: 'companies.survey', params: {
          id: company,
          taxonomy: index.code,
          survey: index.survey && index.survey.id  || null,
        }
      }
    },
  },

  mounted () {
    this.getResource()
  },
}
</script>
