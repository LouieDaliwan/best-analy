<template>
  <admin>
    <metatag :title="resource.data.name"></metatag>

    <template v-if="resource.loading">
      <skeleton-show></skeleton-show>
    </template>

    <template v-else>
      <page-header :back="{ to: { name: 'companies.owned' }, text: trans('Back') }">
        <template v-slot:title>
          <span :class="$vuetify.breakpoint.smAndUp ? '' : 'title font-weight-bold'" class="mb-3">{{ resource.data.name }}</span>
        </template>

        <template v-slot:action>
          <!-- Export button -->
          <!-- <export-report-button :items="resource.data.indices"></export-report-button> -->
          <!-- Export button -->

          <!-- List of All Reports button -->
          <can code="customers.reports">
            <v-btn
              
              :block="$vuetify.breakpoint.smAndDown"
              :to="{name: 'companies.reports', params: { id: $route.params.id }}"
              color="primary"
              exact
              large
              v-if="resourcesHasReport && financialRatio.date != 'empty'"
              >
              <v-icon small left>mdi-file-chart-outline</v-icon>
              {{ __('View Reports') }}
            </v-btn>
          </can>
          <!-- List of All Reports button -->
        </template>
      </page-header>

      <div v-show="resourcesIsNotEmpty">
        <div class="mb-6">
          <v-row>
            <v-col cols="4" md="2" class="py-0"><p class="mb-0 font-weight-bold">{{ trans('Staff Strength') }}:</p></v-col>
            <v-col cols="auto" class="py-0"><p class="mb-0 font-weight-regular"> {{ resource.data.latestStatement && resource.data.latestStatement['metadataStatements']['Number of Staff'] || null }}</p></v-col>
          </v-row>
          <v-row>
            <v-col cols="4" md="2" class="py-0"><p class="mb-0 font-weight-bold">{{ trans('Industry') }}:</p></v-col>
            <v-col cols="auto" class="py-0"><p class="mb-0 font-weight-regular"> {{ resource.data.details && resource.data.details['metadata']['industry_sector'] || null }}</p></v-col>
          </v-row>
        </div>
        <p class="font-weight-regular">
          {{ trans('Please select the type of survey evaluation that you would like to do for :name', {name: resource.data.name}) }}:
        </p>
        <small class="muted--text">
          The <v-icon small color="success">mdi-check-circle</v-icon> icon indicates a completed survey within the current month.
        </small>
        <v-row v-if="financialRatio.date != 'empty'">
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
                    <div v-if="resource['is:finished'] && resource.report.month == current_month" v-on="on" style="position: absolute;">
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
                    <small class="overlines" v-if="resource.report">
                      {{ __('Modified') }}: {{ resource.report.modified }}
                    </small>
                    <small class="overlines" v-else>
                      {{ __('Modified') }}: {{ __('No survey conducted yet') }}
                    </small>
                    <!-- <div class="mt-3" v-for="(item, i) in resources.reports" :key="i">
                      <small class="overlines" v-if="resource.id == item.value['current:index'].taxonomy.id">
                        {{ __('Modified') }}: {{ item.modified }}
                      </small>
                    </div> -->
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
        <v-row v-else>
          <v-col>
            <v-card flat>
              <v-card-text class="text-center">
                <h3 class="muted--text mb-1" v-text="trans('Surveys will appear here')"></h3>
                <p class="muted--text mb-2" v-text="trans('Fill out your financial statement before taking a survey.')"></p>

                <v-btn
                  :to="{
                    name: 'companies.edit',
                    params: { id: $route.params.id },
                    query: { tab: 2 }
                  }"
                  exact
                  color="primary"
                  large
                  ><v-icon small class="mr-2 incomplete--text"
                    >mdi-pencil</v-icon
                  >
                  <span v-text="trans(`Financial Statement`)"></span>
                </v-btn>
              </v-card-text>
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
      return this.resource.data.indices.filter((i) => (i['is:finished'])).length >= 1
    }
  },

  data: () => ({
    api: $api,

    financialRatio: '',
    resource: new Survey,
    current_month: null,
    resources: {
      reports: [],
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
        this.current_month = response.data.data.current_month
        
        console.log(this.resource.data);
      }).finally(() => { this.resource.loading = false })
    },

    getResourceReport () {
      this.resource.loading = true
      axios.get(
        $api.reports.list(this.$route.params.id)
      ).then(response => {
        this.resources.reports = response.data.data
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
    getFinancialRatio() {
      axios.get($api.financialRatio(this.$route.params.id))
      .then(({data}) => {
        this.financialRatio = data;
      })
    }
  },

  mounted () {
    this.getResource()
    this.getResourceReport()
    this.getFinancialRatio()
  },
}
</script>
