<template>
  <section>
    <metatag :title="$t('Deactivated Users')"></metatag>

    <page-header :back="{name: 'users.index'}">
      <template v-slot:utilities>
        <a class="dt-link text--decoration-none mr-4" @click="restoreAllTrashedResources">
          <v-icon small class="mb-1">mdi-restore</v-icon>
          {{ $t('Restore All') }}
        </a>

        <a tag="a" class="dt-link text--decoration-none mr-4">
          <v-icon small class="mb-1">mdi-delete-sweep</v-icon>
          {{ $t('Permanently Delete All') }}
        </a>
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
          item-key="id"
          v-model="dataset.selected"
          @update:options="optionsChanged"
          >

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

          <template v-slot:item.displayname="{ item }">
            <span style="filter: grayscale(0.8);">
              <v-avatar class="mr-6" size="40" color="muted"><v-img :src="item.avatar"></v-img></v-avatar>
            </span>
            <span v-text="item.displayname"></span>
          </template>

          <!-- Deleted -->
          <template v-slot:item.deleted_at="{ item }">
            <span :title="item.deleted_at">{{ trans(item.deleted) }}</span>
          </template>
          <!-- Deleted -->

          <!-- Action buttons -->
          <template v-slot:item.action="{ item }">
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <v-btn small @click="restoreResource(item)" icon v-on="on">
                  <v-icon small>mdi-restore</v-icon>
                </v-btn>
              </template>
              <span>{{ $tc('Restore this user', 1) }}</span>
            </v-tooltip>
            <v-dialog
              width="420"
              v-model="item.active"
              >
              <template v-slot:activator="{ on }">
                <span v-on="on">
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                      <v-btn small icon v-on="on">
                        <v-icon small>mdi-delete-outline</v-icon>
                      </v-btn>
                    </template>
                    <span>{{ $tc('Deactivate user', 1) }}</span>
                  </v-tooltip>
                </span>
              </template>
              <v-card>
                <v-card-text>
                  <div class="warning--text"><man-throwing-away-paper class="d-block mx-auto" width="200" height="200"></man-throwing-away-paper></div>
                  <p class="headline">{{ $t('You are about to deactivate the selected user.') }}</p>
                  <p>{{ $t('The user will be signed out from the app. Some data related to the account like comments and files will still remain.') }}</p>
                  <p v-html="$t('Are you sure you want to deactivate and move :name to Trash?', {name: item.displayname})"></p>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn @click="item.active = false" text color="link">{{ $t('Cancel') }}</v-btn>
                  <v-btn @click="destroyResource(item)" :disabled="item.loading" :loading="item.loading" text color="warning">
                    {{ $t('Move to Trash') }}
                    <template v-slot:loader>
                      <v-slide-x-transition><v-icon dark class="mdi-spin mr-3">mdi-loading</v-icon></v-slide-x-transition>
                      <span>{{ $tc('Moving to Trash...') }}</span>
                    </template>
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </template>
          <!-- Action buttons -->
        </v-data-table>
      </v-slide-y-reverse-transition>

    </v-card>
    <!-- Data table -->

    <dialogbox>
      <template v-slot:illustration>
        <error-icon class="mx-auto d-block" :width="200" :height="200"></error-icon>
      </template>
    </dialogbox>
  </section>
</template>

<script>
import $api from './routes/api'
import $auth from '@/core/Auth/auth'

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
        { text: trans('Account Name'), align: 'left', value: 'displayname' },
        { text: trans('Email'), value: 'email' },
        { text: trans('Role'), value: 'role' },
        { text: trans('Deactivated'), value: 'deleted_at' },
        { text: trans('Actions'), value: 'action', sortable: false, class: "muted--text" },
      ],
      data: []
    },

    tabletoolbar: {
      toggleTrash: false,
      trashCallback: function () {
        this.bulkTrashResource()
      },
      bulkCount: 0,
      toggleBulkEdit: false,
      listGridView: false,
      verticaldiv: false,
    },
  }),

  computed: {
    options: function () {
      return {
        per_page: this.dataset.options.itemsPerPage,
        page: this.dataset.options.page,
        sort: this.dataset.options.sortBy[0] || undefined,
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
    },

    optionsChanged (options) {
      this.getPaginatedTrashedData(this.options)
    },

    getPaginatedTrashedData: function (params = null, caller = null) {
      params = params ? params : this.$route.query
      this.dataset.loading = true
      axios.get(this.api.trashed(), { params })
        .then(response => {
          this.dataset = Object.assign({}, this.dataset, response.data)
          this.dataset.options = Object.assign(this.dataset.options, response.data.meta, params)
          this.dataset.loading = false
          this.$router.push({query: Object.assign({}, this.$route.query, params)}).catch(err => {})
        })
        .catch(err => {
          this.$store.dispatch('dialog/prompt', {
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

    restoreResource (item) {
      this.dataset.loading = true
      axios.patch($api.restore(item.id))
        .then(response => {
          this.getPaginatedTrashedData()
          this.$store.dispatch('snackbar/show', {
            show: true,
            text: this.$tc('User successfully restored', 1),
          })
        })
        .finally(() => {
          this.dataset.loading = false
        })
    },

    restoreAllTrashedResources () {
      let selected = this.dataset.data.map((item) => item.id)

      this.dataset.loading = true
      axios.patch($api.restore(null), { id: selected })
        .then(response => {
          this.getPaginatedTrashedData()
          this.$store.dispatch('snackbar/show', {
            show: true,
            text: this.$t('All users successfully restored'),
          })
        })
        .finally(() => {
          this.dataset.loading = false
        })
    },

    search: _.debounce(function (event) {
      this.dataset.search = event.srcElement.value || ''
      if (this.dataset.searching) {
        this.options.search = this.dataset.search
        this.getPaginatedData(this.options)
        this.dataset.searching = false
      }
    }, 420),

    focusSearchBar () {
      this.$refs['tablesearch'].focus()
    },

    bulkTrashResource () {
      let selected = this.selected
      axios.delete($api.destroy(null), { data: { id: selected } })
        .then(response => {
          this.getPaginatedTrashedData()
          this.$store.dispatch('snackbar/show', {
            show: true,
            text: this.$tc('User successfully deactivated', this.tabletoolbar.bulkCount)
          })
        })
        .catch(err => {
          this.$store.dispatch('dialog/prompt', {
            show: true,
            width: 400,
            buttons: { cancel: { show: false } },
            title: trans('Whoops! An error occured'),
            text: err.response.data.message,
          })
        })
        .finally(() => {
          this.tabletoolbar.toggleTrash = false
          this.tabletoolbar.toggleBulkEdit = false
        })
    },

    destroyResource (item) {
      item.loading = true
      axios.delete($api.destroy(item.id))
        .then(response => {
          item.active = false
          this.getPaginatedTrashedData()
          this.$store.dispatch('snackbar/show', {
            show: true,
            text: this.$tc('User successfully deactivated', 1)
          })
        })
        .catch(err => {
          this.$store.dispatch('dialog/prompt', {
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
