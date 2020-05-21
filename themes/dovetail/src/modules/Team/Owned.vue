<template>
  <admin>
    <metatag :title="trans('My Team')"></metatag>

    <page-header>
      <template v-slot:utilities>
        <p class="mb-0 muted--text">
          {{ __('Click arrow down icon to view the list of companies per Counselor') }}.
        </p>
      </template>
      <template v-slot:action>
        <v-btn
          :block="$vuetify.breakpoint.smAndDown"
          @click="openExportDialog"
          color="primary"
          large
          >
          <v-icon small left>mdi-file-excel-outline</v-icon>
          {{ trans('Export') }}
        </v-btn>
      </template>
    </page-header>

    <!-- Data table -->
    <div v-show="resourcesIsNotEmpty">
      <div v-for="(team, i) in resources.data" :key="i">
        <h4 class="mb-3">{{ team.name }}</h4>
        <v-card class="mb-4">
          <v-slide-y-reverse-transition mode="out-in">
            <v-data-table
              show-expand
              :headers="resources.headers"
              :hide-default-footer="true"
              :items="team.members"
              :loading="resources.loading"
              :mobile-breakpoint="NaN"
              :options.sync="resources.options"
              :server-items-length="resources.meta.total"
              :show-select="tabletoolbar.toggleBulkEdit"
              @update:options="optionsChanged"
              color="primary"
              item-key="id"
              v-model="resources.selected"
              single-expand
              >
              <template v-slot:progress><span></span></template>

              <template v-slot:expanded-item="{ headers, item }">
                <template v-if="item.customers.length">
                  <td :colspan="headers.length">
                    <template v-for="(customer, k) in item.customers">
                      <p :key="k" class="my-3">
                        <v-tooltip bottom>
                          <template v-slot:activator="{ on }">
                            <span class="mt-1" v-on="on"><router-link tag="a" exact :to="{name: 'teams.reports', params: {customer: customer.id, user: item.id}, query: { from: $route.fullPath }}" v-text="customer.name" class="text-no-wrap text--decoration-none secondary--text"></router-link></span>
                          </template>
                          <span>{{ trans('View Reports') }}</span>
                        </v-tooltip>
                      </p>
                    </template>
                  </td>
                </template>
                <template v-else>
                  <td :colspan="headers.length">
                    <p class="muted--text my-3"><em v-text="__('No companies found.')"></em></p>
                  </td>
                </template>
              </template>

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
              <template v-slot:item.displayname="{ item }">
                <can code="users.show">
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                      <span class="mt-1" v-on="on"><router-link tag="a" exact :to="{ name: 'users.show', params: { id: item.id }, query: { from: $route.fullPath } }" v-text="item.displayname" class="text-no-wrap text--decoration-none"></router-link></span>
                    </template>
                    <span>{{ trans('View member details') }}</span>
                  </v-tooltip>
                  <template v-slot:unpermitted>
                    <span v-text="item.displayname" class="text-no-wrap text--decoration-none mt-1"></span>
                  </template>
                </can>
              </template>
              <!-- Name -->

              <!-- Customer -->
              <!-- <template v-slot:item.customers="{ item }">
                <template v-for="(customer, k) in item.customers">
                  <p :key="k" class="mb-1"><router-link tag="a" exact :to="{name: 'companies.show', params: {id: customer.id}, query: { from: $route.fullPath }}">{{ customer.name }}</router-link></p>
                </template>
              </template> -->
              <!-- Customer -->
            </v-data-table>
          </v-slide-y-reverse-transition>
        </v-card>
      </div>
    </div>
    <!-- Data table -->

  <!-- <code v-text="item" v-for="item in resources"></code> -->
    <!-- Empty state -->
    <div v-if="resourcesIsEmpty">
      <toolbar-menu
        :items.sync="tabletoolbar"
        @update:search="search"
        >
      </toolbar-menu>
      <empty-state>
        <template v-slot:actions>
          <can code="teams.create">
            <v-btn
              large
              color="primary"
              exact
              :to="{name: 'teams.create'}">
              <v-icon small left>mdi-account-multiple-plus-outline</v-icon>
              {{ trans('Add Team') }}
            </v-btn>
          </can>
        </template>
      </empty-state>
    </div>
    <!-- Empty state -->
  </admin>
</template>

<script>
import $api from './routes/api'
import $auth from '@/core/Auth/auth'
import man from '@/components/Icons/ManThrowingAwayPaperIcon.vue'
import { mapActions } from 'vuex'

export default {
  computed: {
    resourcesIsNotEmpty () {
      return !this.resourcesIsEmpty
    },

    resourcesIsEmpty () {
      return window._.isEmpty(this.resources.data) && !this.resources.loading
    },

    options: function () {
      return {
        per_page: this.resources.options.itemsPerPage,
        page: this.resources.options.page,
        sort: this.resources.options.sortBy[0] || undefined,
        order: this.resources.options.sortDesc[0] || false ? 'desc' : 'asc',
      }
    },

    selected: function () {
      return this.resources.selected.map((item) => (item.id) )
    },
  },

  data: () => ({
    api: $api,
    auth: $auth.getUser(),

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
        { text: trans('Member Name'), align: 'left', value: 'displayname', class: 'text-no-wrap' },
        { text: trans('Companies'), align: 'center', value: 'customers:count', class: 'text-no-wrap' },
        { text: trans('No. of Reports'), align: 'center', value: 'reports:count', class: 'text-no-wrap' },
      ],
      data: []
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

  mounted: function () {
    this.changeOptionsFromRouterQueries()
    this.getPaginatedData()
  },

  methods: {
    ...mapActions({
      errorDialog: 'dialog/error',
      loadDialog: 'dialog/loading',
      showDialog: 'dialog/show',
      hideDialog: 'dialog/hide',
      showSnackbar: 'snackbar/show',
    }),

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

    getPaginatedData: function (params = null, caller = null) {
      params = Object.assign(params ? params : this.$route.query, {
        search: this.resources.search,
        user_id: $auth.getId(),
      })
      this.resources.loading = true
      axios.get(this.api.owned(), { params })
        .then(response => {
          this.resources = Object.assign({}, this.resources, response.data)
          this.resources.options = Object.assign(this.resources.options, response.data.meta, params)
          this.resources.loading = false
          this.$router.push({query: Object.assign({}, this.$route.query, params)}).catch(err => {})
        })
        .catch(err => {
          this.errorDialog({
            width: 400,
            buttons: { cancel: { show: false } },
            title: trans('Whoops! An error occured'),
            text: err.response.data.message,
          })
        })
        .finally(() => {
          this.resources.data.map(function (data) {
            return Object.assign(data, {loading: false})
          })
        })
    },

    goToShowTeamPage (team) {
      return { name: 'teams.show', params: { id: team.id, slug: team.name } }
    },

    search: _.debounce(function (event) {
      this.resources.search = event.srcElement.value || ''
      this.tabletoolbar.isSearching = false
      if (this.resources.searching) {
        this.getPaginatedData(this.options, 'search')
        this.resources.searching = false
      }
    }, 200),

    focusSearchBar () {
      this.$refs['tablesearch'].focus()
    },

    bulkTrashResource () {
      let selected = this.selected
      axios.delete($api.destroy(null), { data: { id: selected } })
        .then(response => {
          this.getPaginatedData(null, 'bulkTrashResource')
          this.tabletoolbar.toggleTrash = false
          this.tabletoolbar.toggleBulkEdit = false
          this.hideDialog()
          this.showSnackbar({
            text: trans_choice('Team successfully moved to trash', this.tabletoolbar.bulkCount)
          })
        })
        .catch(err => {
          this.errorDialog({
            width: 400,
            buttons: { cancel: { show: false } },
            title: trans('Whoops! An error occured'),
            text: err.response.data.message,
          })
        })
    },

    askUserToDestroyTeam (item) {
      this.showDialog({
        color: 'warning',
        illustration: man,
        illustrationWidth: 200,
        illustrationHeight: 160,
        width: '420',
        title: 'You are about to move to trash the selected team.',
        text: ['Some data related to team will still remain.', trans('Are you sure you want to move :name to Trash?', {name: item.name})],
        buttons: {
          cancel: { show: true, color: 'link' },
          action: {
            text: 'Move to Trash',
            color: 'warning',
            callback: (dialog) => {
              this.loadDialog(true)
              this.destroyResource(item)
            }
          }
        }
      })
    },

    destroyResource (item) {
      item.loading = true
      axios.delete($api.destroy(item.id))
        .then(response => {
          item.active = false
          this.getPaginatedData(null, 'destroyResource')
          this.showSnackbar({
            text: trans_choice('Team successfully moved to trash', 1)
          })
          this.hideDialog()
        })
        .catch(err => {
          this.errorDialog({
            width: 400,
            buttons: { cancel: { show: false } },
            title: trans('Whoops! An error occured'),
            text: err.response.data.message,
          })
        })
        .finally(() => {
          item.active = false
          item.loading = false
        })
    },

    openExportDialog () {
      this.$store.dispatch('dialog/show', {
        illustration: () => import('@/components/Icons/ExportIcon.vue'),
        title: trans('Export Report'),
        text: [trans('Download the table as Excel file.')],
        buttons: {
          action: {
            text: trans('Export'),
            callback: () => {
              let userId = $auth.getId()
              window.location.href = `/teams/export?user_id=${userId}`
              // return new Promise((resolve, reject) => {
              //   let userId = $auth.getId()
              //   axios.get(`/teams/export?user_id=${userId}`)
              //   this.$store.dispatch('dialog/hide')
              // })
            },
          }
        },
      })
    }
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
