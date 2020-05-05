<template>
  <admin>
    <metatag :title="resource.data.name"></metatag>

    <page-header>
      <template v-slot:back>
        <div class="mb-2">
          <can code="teams.index">
            <router-link tag="a" exact :to="{ name: 'teams.index' }" class="text--decoration-none body-1 dt-link">
              <v-icon small class="mb-1">mdi mdi-chevron-left</v-icon>
              <span v-text="trans('All Teams')"></span>
            </router-link>
            <template v-slot:unpermitted>
              <can code="teams.owned">
                <router-link tag="a" exact :to="{ name: 'teams.owned' }" class="text--decoration-none body-1 dt-link">
                  <v-icon small class="mb-1">mdi mdi-chevron-left</v-icon>
                  <span v-text="trans('My Team')"></span>
                </router-link>
              </can>
            </template>
          </can>
        </div>
      </template>
      <template v-slot:title>{{ resource.data.name }}</template>
      <template v-slot:utilities>
        <can code="teams.show">
          <router-link tag="a" class="dt-link text--decoration-none mr-6" exact :to="{name: 'teams.edit'}">
            <v-icon small class="mb-1">mdi-pencil-outline</v-icon>
            {{ trans('Edit') }}
          </router-link>
        </can>
        <can code="teams.destroy">
          <a href="#" @click.prevent="askUserToDestroyResource(resource)" class="dt-link text--decoration-none mr-6">
            <v-icon small class="mb-1">mdi-delete-outline</v-icon>
            {{ trans('Move to Trash') }}
          </a>
        </can>
      </template>
    </page-header>

    <v-row>
      <v-col cols="12" md="12">
        <v-card class="mb-5">
          <v-card-text>
            <template v-if="resource.data.description">
              <h4 class="mb-3" v-text="trans('Team Detail')"></h4>
              <p class="mb-4">{{ resource.data.description }}</p>
            </template>

            <h4 class="mb-3" v-text="trans('Team Manager')"></h4>
            <user-account-detail-card v-model="resource.data.lead"></user-account-detail-card>
          </v-card-text>

          <div class="d-flex mb-4">
            <v-divider></v-divider>
            <v-icon small color="muted" class="mx-3 mt-n2">mdi-account-settings</v-icon>
            <v-divider></v-divider>
          </div>

          <v-row>
            <v-col cols="12" md="6" class="pt-0">
              <v-card-text class="pt-0">
                <h4 class="mb-5">{{ trans('Team Members') }}</h4>
                <treeview-pagination
                  :items="resource.data.users"
                  :search="search"
                  :activatable="true"
                  @active="previewMember"
                ></treeview-pagination>
              </v-card-text>
            </v-col>

            <v-divider vertical></v-divider>

            <v-col class="pt-0">
              <v-scroll-y-transition mode="out-in">
                <div v-if="resource.preview" :key="resource.preview.id">
                  <v-row justify="center">
                    <v-col cols="auto" class="pt-1">
                      <div class=" d-flex">
                        <v-avatar class="mr-3" size="32" color="workspace">
                          <v-img :src="resource.preview.avatar"></v-img>
                        </v-avatar>
                        <p class="font-weight-bold" v-text="resource.preview.displayname"></p>
                      </div>
                      <div class="mb-2">
                        <v-icon small class="mr-2 muted--text">mdi-at</v-icon>
                        <span class="muted--text">{{ resource.preview.username }}</span>
                      </div>
                      <div class="muted--text mb-2">
                        <v-icon small class="mr-2 muted--text">mdi-email-outline</v-icon>
                        <span class="muted--text">{{ resource.preview.email }}</span>
                      </div>
                      <div class="muted--text">
                        <v-icon small class="mr-2 muted--text">mdi-account-outline</v-icon>
                        {{ resource.preview.role }}
                      </div>
                    </v-col>
                  </v-row>
                </div>
                <div v-else>
                  <v-row justify="center">
                    <v-col cols="auto">
                      <checklist-icon height="100" class="primary--text" style="filter: grayscale(0.8) brightness(150%);"></checklist-icon>
                      <p class="muted--text pa-3">
                        {{ trans('Select members from the list to view details') }}
                      </p>
                    </v-col>
                  </v-row>
                </div>
              </v-scroll-y-transition>
            </v-col>
          </v-row>
        </v-card>

        <!-- Data Table -->
        <h3 class="mb-3">{{ __('Team Reports') }}</h3>
        <v-card>
          <v-slide-y-reverse-transition mode="out-in">
            <v-data-table
              :headers="resources.headers"
              :hide-default-footer="true"
              :items="resource.data.members"
              :loading="resources.loading"
              :mobile-breakpoint="NaN"
              :options.sync="resources.options"
              :server-items-length="resources.meta.total"
              :show-select="tabletoolbar.toggleBulkEdit"
              @update:options="optionsChanged"
              color="primary"
              item-key="id"
              show-expand
              single-expand
              v-model="resources.selected"
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
        <!-- Data Table -->

        <div style="height: 150px;"></div>
      </v-col>
    </v-row>
  </admin>
</template>

<script>
import $api from './routes/api'
import $auth from '@/core/Auth/auth'
import man from '@/components/Icons/ManThrowingAwayPaperIcon.vue'
import Team from './Models/Team'
import { mapActions } from 'vuex'

export default {
  computed: {
    filter () {
      return undefined
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
    resource: new Team,
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
    search: null,
  }),

  methods: {
    ...mapActions({
      showDialog: 'dialog/show',
      hideDialog: 'dialog/hide',
      errorDialog: 'dialog/error',
      showSnackbar: 'snackbar/show',
      loadDialog: 'dialog/loading',
    }),

    getResource () {
      axios.get(
        $api.show(this.$route.params.id)
      ).then(response => {
        this.resource.data = response.data.data
        this.resource.data.users = this.resource.data.members
      }).finally(() => { this.resource.loading = false })
    },

    askUserToDestroyResource (resource) {
      this.showDialog({
        color: 'warning',
        illustration: () => import('@/components/Icons/ManThrowingAwayPaperIcon.vue'),
        illustrationWidth: 200,
        illustrationHeight: 160,
        width: '420',
        title: trans('You are about to move to trash the selected team.'),
        text: [trans('The user will be signed out from the app. Some data related to the account like comments and files will still remain.'), trans('Are you sure you want to deactivate and move :name to Trash?', {name: resource.data.name})],
        buttons: {
          cancel: { show: true, color: 'link' },
          action: {
            text: trans('Move to Trash'),
            color: 'warning',
            callback: (dialog) => {
              this.loadDialog(true)
              this.destroyResource(resource)
            }
          }
        }
      })
    },

    destroyResource (item) {
      item.loading = true
      axios.delete(
        $api.destroy(item.data.id)
      ).then(response => {
        this.hideDialog()
        this.showSnackbar({
          show: true,
          text: trans_choice('Team successfully moved to trash', 1)
        })
        this.$router.push({ name: 'teams.index' })
      }).catch(err => {
        this.errorDialog({
          width: 400,
          buttons: { cancel: { show: false } },
          title: trans('Whoops! An error occured'),
          text: err.response.data.message,
        })
      }).finally(() => { item.loading = false })
    },

    previewMember (val) {
      this.resource.preview = val[0]
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

    openExportDialog () {
      this.$store.dispatch('dialog/show', {
        illustration: () => import('@/components/Icons/ExportIcon.vue'),
        title: trans('Export Report'),
        text: [trans('Download the table as PDF file.')],
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

  mounted () {
    this.getResource()
    this.changeOptionsFromRouterQueries()
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
