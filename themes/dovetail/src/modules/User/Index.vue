<template>
  <section>
    <metatag :title="trans('All Users')"></metatag>

    <page-header>
      <template v-slot:utilities>
        <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: 'users.trashed'}">
          <v-icon small class="mb-1">mdi-delete-empty</v-icon>
          {{ trans('Deactivated Users') }}
        </router-link>
      </template>

      <template v-slot:action>
        <v-btn large color="primary" exact :to="{ name: 'users.create' }">
          <v-icon left>mdi-account-plus-outline</v-icon>
          {{ trans('Add User') }}
        </v-btn>
      </template>
    </page-header>

    <!-- Data table -->
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
      <v-divider></v-divider>
      <v-slide-y-reverse-transition mode="out-in">
        <v-data-table
          :headers="dataset.headers"
          :items="dataset.data"
          :loading="dataset.loading"
          :options.sync="dataset.options"
          :server-items-length="dataset.meta.total"
          :show-select="tabletoolbar.toggleBulkEdit"
          :mobile-breakpoint="NaN"
          item-key="id"
          v-model="dataset.selected"
          @update:options="optionsChanged"
          >

          <template v-slot:progress><span></span></template>

          <template v-slot:loading>
            <v-slide-y-transition mode="out-in">
              <div>
                <div class="d-flex" v-for="(j,i) in dataset.options.itemsPerPage" :key="i">
                  <v-skeleton-loader
                    class="px-4 py-3 mr-4"
                    type="avatar"
                  ></v-skeleton-loader>
                  <v-skeleton-loader
                    class="px-4 py-3"
                    width="100%"
                    type="table-row"
                  ></v-skeleton-loader>
                </div>
              </div>
            </v-slide-y-transition>
          </template>

          <template v-slot:item.id="{ item }">
            <div class="d-flex align-items-center">
              <v-tooltip v-if="auth.id == item.id" bottom>
                <template v-slot:activator="{ on }">
                  <v-badge
                    avatar
                    bordered
                    color="muted"
                    offset-x="35"
                    offset-y="15"
                    overlap
                    >
                    <template v-slot:badge>
                      <v-avatar>
                        <i class="small mdi mdi-home-account" style="font-size: 12px"></i>
                      </v-avatar>
                    </template>
                    <v-avatar v-on="on" class="mr-6" size="32" color="muted"><v-img :src="item.avatar"></v-img></v-avatar>
                  </v-badge>
                </template>
                <span>{{ $t('This is your account') }}</span>
              </v-tooltip>
              <v-avatar v-else class="mr-6" size="32" color="muted"><v-img :src="item.avatar"></v-img></v-avatar>

              <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                  <span class="mt-1" v-on="on"><router-link tag="a" exact :to="goToShowUserPage(item)" v-text="item.displayname" class="text-no-wrap"></router-link></span>
                </template>
                <span>{{ $t('View Details') }}</span>
              </v-tooltip>
            </div>
          </template>

          <!-- Created & Modified -->
          <template v-slot:item.updated_at="{ item }">
            <span class="text-no-wrap" :title="item.updated_at">{{ trans(item.modified) }}</span>
          </template>
          <!-- Created & Modified -->

          <!-- Action buttons -->
          <template v-slot:item.action="{ item }">
            <div class="text-no-wrap">
              <!-- Edit -->
              <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                  <v-btn :to="{name: 'users.edit', params: {id: item.id}}" icon v-on="on">
                    <v-icon small>mdi-pencil-outline</v-icon>
                  </v-btn>
                </template>
                <span>{{ $tc('Edit this user', 1) }}</span>
              </v-tooltip>
              <!-- Edit -->
              <!-- Move to Trash -->
              <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                  <v-btn @click="askUserToDestroyUser(item)" icon v-on="on">
                    <v-icon small>mdi-delete-outline</v-icon>
                  </v-btn>
                </template>
                <span>{{ $tc('Deactivate user', 1) }}</span>
              </v-tooltip>
              <!-- Move to Trash -->
            </div>
          </template>
          <!-- Action buttons -->
        </v-data-table>
      </v-slide-y-reverse-transition>
    </v-card>
    <!-- Data table -->

    <dialogbox>
      <error-icon class="mx-auto d-block" :width="200" :height="200"></error-icon>
    </dialogbox>
  </section>
</template>

<script>
import $api from './routes/api'
import $auth from '@/core/Auth/auth'
import man from '@/components/Icons/ManThrowingAwayPaperIcon.vue'

export default {
  data: () => ({
    api: $api,

    auth: $auth.getUser(),

    dataset: {
      loading: true,
      search: null,
      options: {
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        // rowsPerPage: [5, 10, 15, 20, 50, 100],
      },
      meta: {},
      modes: {
        bulkedit: false,
      },
      selected: [],
      headers: [
        { text: trans('Account Name'), align: 'left', value: 'id' },
        { text: trans('Role'), value: 'role' },
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

  computed: {
    options: function () {
      return {
        per_page: this.dataset.options.itemsPerPage,
        page: this.dataset.options.page,
        sort: this.dataset.options.sortBy[0] || undefined,
        order: this.dataset.options.sortDesc[0] || false ? 'desc' : 'asc',
      }
    },

    selected: function () {
      return this.dataset.selected.map((item) => (item.id) )
    },
  },

  mounted: function () {
    this.changeOptionsFromRouterQueries()
  },

  methods: {
    changeOptionsFromRouterQueries () {
      this.options.per_page = this.$route.query.per_page
      this.options.page = parseInt(this.$route.query.page)
      this.options.search = this.$route.query.search
      this.dataset.search = this.options.search
      this.tabletoolbar.search = this.options.search
    },

    optionsChanged (options) {
      this.getPaginatedData(this.options, 'optionsChaned')
    },

    getPaginatedData: function (params = null, caller = null) {
      // console.log(`getPagintedData Called by ${caller}`);
      params = params ? params : this.$route.query
      this.dataset.loading = true
      axios.get(this.api.list(), { params })
        .then(response => {
          this.dataset = Object.assign({}, this.dataset, response.data)
          this.dataset.options = Object.assign(this.dataset.options, response.data.meta, params)
          this.dataset.loading = false
          this.$router.push({query: Object.assign({}, this.$route.query, params)}).catch(err => {})
        })
        .catch(err => {
          this.$store.dispatch('dialog/error', {
            show: true,
            width: 400,
            buttons: { cancel: { show: false } },
            title: trans('Whoops! An error occured'),
            text: err.response.data.message,
          })
        })
        .finally(() => {
          this.dataset.data.map(function (data) {
            return Object.assign(data, {loading: false})
          })
        })
    },

    goToShowUserPage (user) {
      return { name: 'users.show', params: { id: user.id, slug: user.username } }
    },

    search: _.debounce(function (event) {
      this.dataset.search = event.srcElement.value || ''
      this.tabletoolbar.isSearching = false
      if (this.dataset.searching) {
        this.options.search = this.dataset.search
        this.getPaginatedData(this.options, 'search')
        this.dataset.searching = false
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
          this.$store.dispatch('dialog/close')
          this.$store.dispatch('snackbar/show', {
            show: true,
            text: this.$tc('User successfully deactivated', this.tabletoolbar.bulkCount)
          })
        })
        .catch(err => {
          this.$store.dispatch('dialog/error', {
            show: true,
            width: 400,
            buttons: { cancel: { show: false } },
            title: trans('Whoops! An error occured'),
            text: err.response.data.message,
          })
        })
    },

    askUserToDestroyUser (item) {
      this.$store.dispatch('dialog/prompt', {
        show: true,
        color: 'warning',
        illustration: man,
        illustrationWidth: 200,
        illustrationHeight: 160,
        width: '420',
        title: 'You are about to deactivate the selected user.',
        text: ['The user will be signed out from the app. Some data related to the account like comments and files will still remain.', this.$t('Are you sure you want to deactivate and move :name to Trash?', {name: item.displayname})],
        buttons: {
          cancel: { show: true, color: 'link' },
          action: {
            text: 'Move to Trash',
            color: 'warning',
            callback: (dialog) => {
              this.$store.dispatch('dialog/loading', true)
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
          this.$store.dispatch('snackbar/show', {
            show: true,
            text: this.$tc('User successfully deactivated', 1)
          })
          this.$store.dispatch('dialog/prompt', { show: false })
        })
        .catch(err => {
          this.$store.dispatch('dialog/error', {
            show: true,
            width: 400,
            buttons: { cancel: { show: false } },
            title: this.$t('Whoops! An error occured'),
            text: err.response.data.message,
          })
        })
        .finally(() => {
          item.active = false
          item.loading = false
        })
    },
  },

  watch: {
    'dataset.search': function (val) {
      this.dataset.searching = true
    },

    'dataset.selected': function (val) {
      this.tabletoolbar.bulkCount = val.length
    },

    'tabletoolbar.toggleBulkEdit': function (val) {
      if (!val) {
        this.dataset.selected = []
      }
    }
  },
}
</script>
