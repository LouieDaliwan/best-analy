<template>
  <admin>
    <metatag :title="trans('All Customer')"></metatag>

    <page-header>
      <template v-slot:utilities>
        <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: 'customers.trashed'}">
          <v-icon small left>mdi-delete-outline</v-icon>
          {{ trans('Trashed Customer') }}
        </router-link>
      </template>

      <template v-slot:action>
        <v-btn large color="primary" exact :to="{ name: 'customers.generate' }">
          <v-icon small left>mdi-file-document-box-search-outline</v-icon>
          {{ trans('Generate Report') }}
        </v-btn>
      </template>
    </page-header>

    <!-- Data table -->
    <div v-show="resourcesIsNotEmpty">
      <v-card>
        <toolbar-menu
          :items.sync="tabletoolbar"
          bulk
          downloadable
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
              <template v-slot:item.name="{ item }">
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <span class="mt-1" v-on="on"><router-link tag="a" exact :to="goToShowIndexPage(item)" v-text="item.name" class="text-no-wrap text--decoration-none"></router-link></span>
                  </template>
                  <span>{{ trans('View Details') }}</span>
                </v-tooltip>
              </template>
              <!-- Name -->

            <!-- Modified -->
            <template v-slot:item.updated_at="{ item }">
              <span class="text-no-wrap" :title="item.updated_at">{{ trans(item.modified) }}</span>
            </template>
            <!-- Modified -->

            <!-- Action buttons -->
            <template v-slot:item.action="{ item }">
              <div class="text-no-wrap">
                <!-- Move to Trash -->
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn @click="askUserToDestroyCustomer(item)" icon v-on="on">
                      <v-icon small>mdi-delete-outline</v-icon>
                    </v-btn>
                  </template>
                  <span>{{ trans('Move to trash') }}</span>
                </v-tooltip>
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
            :to="{name: 'customers.create'}">
            <v-icon small left>mdi-file-document-box-search-outline</v-icon>
            {{ trans('Generate Report') }}
          </v-btn>
        </template>
      </empty-state>
    </div>
    <!-- Empty state -->
  </admin>
</template>

<script>
import $api from './routes/api'
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
        { text: trans('Company Name'), align: 'left', value: 'name' },
        { text: trans('Refnum'), align: 'left', value: 'refnum' },
        { text: trans('Code'), align: 'left', value: 'code' },
        { text: trans('Last Modified'), value: 'updated_at' },
        { text: trans('Actions'), align: 'center', value: 'action', sortable: false, class: 'muted--text' },
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
      params = Object.assign(params ? params : this.$route.query, { search: this.resources.search })
      this.resources.loading = true
      axios.get(this.api.list(), { params })
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

    search: _.debounce(function (event) {
      this.resources.search = event.srcElement.value || ''
      this.tabletoolbar.isSearching = false
      if (this.resources.searching) {
        this.getPaginatedData(this.options, 'search')
        this.resources.searching = false
      }
    }, 200),

    goToShowIndexPage (customer) {
      return { name: 'customers.show', params: { id: customer.id } }
    },

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
            text: trans_choice('Customer successfully moved to trash', this.tabletoolbar.bulkCount)
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

    askUserToDestroyCustomer (item) {
      this.showDialog({
        color: 'warning',
        illustration: man,
        illustrationWidth: 200,
        illustrationHeight: 160,
        width: '420',
        title: 'You are about to move to trash the selected customer.',
        text: ['Some data related to customer will still remain.', trans('Are you sure you want to move :name to Trash?', {name: item.name})],
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
            text: trans_choice('Customer successfully moved to trash', 1)
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
  },

  mounted: function () {
    this.changeOptionsFromRouterQueries()
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
