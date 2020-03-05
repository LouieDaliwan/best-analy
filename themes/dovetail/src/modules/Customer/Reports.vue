<template>
  <admin>
    <metatag :title="resource.data.name"></metatag>

    <page-header>
      <template v-slot:back>
        <div class="mb-2">
          <can code="customers.index">
            <router-link tag="a" exact :to="{ name: 'companies.show' }" class="text--decoration-none body-1 dt-link">
              <v-icon small class="mb-1">mdi mdi-chevron-left</v-icon>
              <span v-text="trans('Indices')"></span>
            </router-link>
            <template v-slot:unpermitted>
              <router-link tag="a" exact :to="{ name: 'companies.show' }" class="text--decoration-none body-1 dt-link">
                <v-icon small class="mb-1">mdi mdi-chevron-left</v-icon>
                <span v-text="trans('Indices')"></span>
              </router-link>
            </template>
          </can>
        </div>
      </template>
      <template v-slot:title>{{ resource.data.name }}</template>
      <template v-slot:utilities>
        <h3 class="muted--text" v-text="trans('Reports List')"></h3>
      </template>

      <template v-slot:action>
        <!-- <v-btn :block="$vuetify.breakpoint.smAndDown" large color="primary" exact :to="{ name: 'companies.find' }">
          <v-icon small left>mdi-file-document-box-search-outline</v-icon>
          {{ trans('Find Company') }}
        </v-btn> -->
        <v-btn
          :block="$vuetify.breakpoint.smAndDown"
          @click="previewOverallReport"
          color="primary"
          exact
          large
          >
          <v-icon small left>mdi-paperclip</v-icon>
          {{ __('Overall Report') }}
        </v-btn>
      </template>
    </page-header>

    <!-- Data table -->
    <div v-show="resourcesIsNotEmpty">
      <v-card>
        <toolbar-menu
          :items.sync="tabletoolbar"
          bulk
          trashable
          @update:search="search"
          @update:trash="bulkTrashResource"
          >
        </toolbar-menu>
        <v-slide-y-reverse-transition mode="out-in">
          <v-data-table
            :headers="resources.headers"
            :items="resources.data"
            :loading="resources.loading"
            :mobile-breakpoint="NaN"
            :options.sync="resources.options"
            :server-items-length="resources.meta.total"
            :show-select="tabletoolbar.toggleBulkEdit"
            @update:options="optionsChanged"
            color="primary"
            item-key="id"
            v-model="resources.selected"
            >
            <template v-slot:progress><span></span></template>

            <template v-slot:loading>
              <v-slide-y-transition mode="out-in">
                <div>
                  <div v-for="(j,i) in resources.options.itemsPerPage" :key="i">
                    <skeleton-table></skeleton-table>
                  </div>
                </div>
              </v-slide-y-transition>
            </template>

            <!-- Name -->
            <template v-slot:item.key="{ item }">
              <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                  <span class="mt-1" v-on="on"><router-link tag="a" exact :to="goToShowPage(item)" v-text="item.key" class="text-no-wrap text--decoration-none"></router-link></span>
                </template>
                <span>{{ trans('View Details') }}</span>
              </v-tooltip>
            </template>
            <!-- Name -->

            <!-- Created -->
            <template v-slot:item.created_at="{ item }">
              <span class="text-no-wrap" :title="item.created_at">{{ trans(item.created) }}</span>
            </template>
            <!-- Created -->

            <!-- Author -->
            <template v-slot:item.user_id="{ item }">
              <span class="text-no-wrap" v-text="item.author"></span>
            </template>
            <!-- Author -->

            <!-- Action buttons -->
            <template v-slot:item.action="{ item }">
              <div class="text-no-wrap">
                <!-- Send Report -->
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn @click="sendToCrm(item)" icon v-on="on">
                      <v-icon small>mdi-send</v-icon>
                    </v-btn>
                  </template>
                  <span>{{ trans('Send Report to CRM') }}</span>
                </v-tooltip>
                <!-- Send Report -->
                <!-- Show Reports -->
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn :to="goToSurveyPage(item)" icon v-on="on">
                      <v-icon small>mdi-file-search</v-icon>
                    </v-btn>
                  </template>
                  <span>{{ trans('View Survey') }}</span>
                </v-tooltip>
                <!-- Show Reports -->
                <!-- Move to Trash -->
                <!-- <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn @click="askUserToDestroyReport(item)" icon v-on="on">
                      <v-icon small>mdi-delete-outline</v-icon>
                    </v-btn>
                  </template>
                  <span>{{ trans('Move to trash') }}</span>
                </v-tooltip> -->
                <!-- Move to Trash -->
              </div>
            </template>
            <!-- Action buttons -->
          </v-data-table>
        </v-slide-y-reverse-transition>
      </v-card>
    </div>
    <!-- Data table -->

    <!-- Empty state -->
    <div v-if="resourcesIsEmpty">
      <empty-state>
        <template v-slot:actions>
          <v-btn
            large
            color="primary"
            exact
            :to="{name: 'companies.owned'}">
            <v-icon small left>mdi-file-document-box-search-outline</v-icon>
            {{ trans('Back to My Companies') }}
          </v-btn>
        </template>
      </empty-state>
    </div>
    <!-- Empty state -->
  </admin>
</template>

<script>
import $api from './routes/api'
import Company from './Models/Company'

export default {
  computed: {
    resourcesIsNotEmpty () {
      return !this.resourcesIsEmpty
    },

    resourcesIsEmpty () {
      return window._.isEmpty(this.resources.data) && !this.resources.loading
    },
  },

  data: () => ({
    resource: new Company,
    resources: {
      loading: true,
      search: null,
      options: {
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        sortDesc: [],
        sortBy: [],
      },
      meta: {},
      modes: {
        bulkedit: false,
      },
      selected: [],
      headers: [
        { text: trans('Report Type'), align: 'left', value: 'key', class: 'text-no-wrap' },
        { text: trans('Generated'), value: 'created_at', class: 'text-no-wrap' },
        { text: trans('Generated By'), align: 'left', value: 'user_id', class: 'text-no-wrap' },
        { text: trans('Actions'), align: 'center', value: 'action', sortable: false, class: 'muted--text text-no-wrap' },
      ],
      data: [],
    },

    tabletoolbar: {
      bulkCount: 0,
      isSearching: false,
      search: null,
      listGridView: false,
      toggleBulkEdit: false,
      toggleTrash: false,
      verticaldiv: false,
    },
  }),

  methods: {
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

    previewOverallReport () {
      this.$router.push({ name: 'reports.overall', query: {
        type: 'overall'
      }, params: { id: this.$route.params.id } })
    },

    changeOptionsFromRouterQueries () {
      this.options.per_page = this.$route.query.per_page
      this.options.page = parseInt(this.$route.query.page)
      this.options.search = this.$route.query.search
      this.resources.search = this.options.search
      this.tabletoolbar.search = this.options.search
    },

    optionsChanged (options) {
      this.getPaginatedData(this.options)
    },

    getResource () {
      this.resource.loading = true
      this.resource.isPrestine = false
      axios.get(
        $api.show(this.$route.params.id)
      ).then(response => {
        this.resource.data = response.data.data
      }).finally(() => {
        this.load(false)
        this.resource.isPrestine = true
      })
    },

    getPaginatedData (params = null, caller = null) {
      params = Object.assign(params ? params : this.$route.query, { search: this.resources.search })
      this.resources.loading = true
      axios.get(
        $api.reports.list(this.$route.params.id), { params }
      ).then(response => {
        this.resources = Object.assign({}, this.resources, response.data)
        this.resources.options = Object.assign(this.resources.options, response.data.meta, params)
        this.resources.loading = false
        this.$router.push({query: Object.assign({}, this.$route.query, params)}).catch(err => {})
      }).catch(err => {
        this.errorDialog({
          width: 400,
          buttons: { cancel: { show: false } },
          title: trans('Whoops! An error occured'),
          text: err.response.data.message,
        })
      }).finally(() => {
        this.resources.data.map(function (data) {
          return Object.assign(data, {loading: false})
        })
      })
    },

    askUserToDestroyReport (item) {
      this.showDialog({
        color: 'error',
        illustration: man,
        illustrationWidth: 200,
        illustrationHeight: 160,
        width: '420',
        title: 'You are about to move to trash the selected company.',
        text: ['Some data related to company will still remain.', trans('Are you sure you want to move :name to Trash?', {name: item.name})],
        buttons: {
          cancel: { show: true, color: 'link' },
          action: {
            text: 'Move to Trash',
            color: 'error',
            callback: (dialog) => {
              this.loadDialog(true)
              this.destroyResource(item)
            }
          }
        }
      })
    },

    goToShowPage (item) {
      return { name: 'reports.show', params: { id: this.$route.params.id, report: item.id } }
    },

    goToSurveyPage (item) {
      return {
        name: 'companies.response',
        query: { month: item.remarks },
        params: {
          id: this.$route.params.id,
          taxonomy: item.value['current:index']['taxonomy']['id'] || null,
          survey: item.value['survey:id'],
        },
      }
    },

    load (val = true) {
      this.resource.loading = val
    },

    search: _.debounce(function (event) {
      this.resources.search = event.srcElement.value || ''
      this.tabletoolbar.isSearching = false
      if (this.resources.searching) {
        this.getPaginatedData(this.options, 'search')
        this.resources.searching = false
      }
    }, 200),

    bulkTrashResource () {
      let selected = this.selected
      axios.delete(
        $api.reports.destroy(null), { data: { id: selected } }
      ).then(response => {
        this.getPaginatedData(null, 'bulkTrashResource')
        this.tabletoolbar.toggleTrash = false
        this.tabletoolbar.toggleBulkEdit = false
        this.hideDialog()
        this.showSnackbar({
          text: trans_choice('Company successfully moved to trash', this.tabletoolbar.bulkCount)
        })
      }).catch(err => {
        this.errorDialog({
          width: 400,
          buttons: { cancel: { show: false } },
          title: trans('Whoops! An error occured'),
          text: err.response.data.message,
        })
      })
    },
  },

  mounted () {
    this.getResource()
    this.getPaginatedData()
  },

  watch: {
    'resources.search': function (val) {
      this.resources.searching = true
    },

    'resources.selected': function (val) {
      this.tabletoolbar.bulkCount = val.length
    },

    'tabletoolbar.toggleBulkEdit': function (val) {
      if (!val) {
        this.resources.selected = []
      }
    }
  },
}
</script>
