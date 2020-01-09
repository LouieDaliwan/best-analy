<template>
  <section>
    <!-- :back="{name: 'users.index'}" -->
    <metatag :title="trans('All Users')"></metatag>
    <page-header>
      <template v-slot:utilities>
        <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: 'dashboard'}">
          <v-icon small class="mb-1">mdi-delete-empty</v-icon>
          {{ trans('Deactivated') }}
        </router-link>

        <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: 'dashboard'}">
          <v-icon small class="mb-1">mdi-upload</v-icon>
          {{ trans('Import') }}
        </router-link>
      </template>

      <template v-slot:action>
        <v-btn large color="primary" exact :to="{ name: 'users.create' }">
          <v-icon left>mdi-account-plus-outline</v-icon>
          {{ trans("Add User") }}
        </v-btn>
      </template>
    </page-header>

    <!-- Data table -->
    <v-card>
      <div>
        Selected Items from the table:
        {{ selected }}
      </div>
      <toolbar-menu :items.sync="tabletoolbar">
        <template v-slot:search>
          <v-text-field
            :placeholder="trans('Search ctrl+/')"
            clear-icon="mdi-close-circle-outline"
            @keydown.native="search"
            @shortkey.native="focusSearchBar"
            clearable
            dense
            hide-details
            outlined
            prepend-inner-icon="mdi mdi-magnify"
            ref="tablesearch"
            rounded
            single-line
            v-model="dataset.search"
            v-shortkey="['ctrl', '/']"
          ></v-text-field>
        </template>
      </toolbar-menu>
      <v-divider></v-divider>
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

        <template v-slot:item.displayname="{ item }">
          <div class="d-flex">
            <v-avatar size="32" class="mr-4 pa-2" color="primary"><img :src="item.avatar"></v-avatar>
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <router-link tag="a" exact :to="goToShowUserPage(item)" v-on="on" v-text="item.displayname"></router-link>
              </template>
              <span>{{ trans('View Details') }}</span>
            </v-tooltip>
          </div>
        </template>

        <!-- Created & Modified -->
        <template v-slot:item.created_at="{ item }">
          <span :title="item.created_at">{{ trans(item.created) }}</span>
        </template>
        <template v-slot:item.updated_at="{ item }">
          <span :title="item.updated_at">{{ trans(item.modified) }}</span>
        </template>
        <!-- Created & Modified -->

        <!-- Action buttons -->
        <template v-slot:item.action="{ item }">
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn small icon v-on="on">
                <v-icon small>mdi-pencil-outline</v-icon>
              </v-btn>
            </template>
            <span>{{ __('Edit this user') }}</span>
          </v-tooltip>
          <v-btn small icon>
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <v-btn small icon v-on="on">
                  <v-icon small>mdi-delete-outline</v-icon>
                </v-btn>
              </template>
              <span>{{ __('Move this user to trash') }}</span>
            </v-tooltip>
          </v-btn>
        </template>
        <!-- Action buttons -->

        <!-- Account Name and Avatar -->
        <template v-slot:item.name="{ item }">
          <td class="pl-0">
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <v-icon small class="muted--text" v-on="on">mdi-home-account</v-icon>
              </template>
              <span>{{ trans('This is your account') }}</span>
            </v-tooltip>
          </td>
          <td><v-avatar size="30"><img :src="item.avatar"></v-avatar></td>
          <td>
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <a exact to="" v-on="on" v-text="item.name"></a>
              </template>
              <span>{{ trans('View Details') }}</span>
            </v-tooltip>
          </td>
        </template>
        <!-- Account Name and Avatar -->
      </v-data-table>
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

export default {
  data: () => ({
    api: $api,

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
        { text: trans('Created'), value: 'created_at' },
        { text: trans('Modified'), value: 'updated_at' },
        { text: trans('Actions'), value: 'action', sortable: false, class: "muted--text" },
      ],
      data: []
    },

    tabletoolbar: {
      toggleTrash: false,
      trashCallback: () => {
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
        // search: this.dataset.search,
        // order: options.sortDesc,
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
      this.getPaginatedData(this.options)
    },

    getPaginatedData: function (params = null, caller = null) {
      params = params ? params : this.$route.query
      this.dataset.loading = true
      axios.get(this.api.list(), { params })
        .then(response => {
          this.dataset = Object.assign({}, this.dataset, response.data)
          this.dataset.options = Object.assign(this.dataset.options, response.data.meta, params)
          // this.dataset.options.itemsPerPage = response.data.meta.per_page
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
    },

    goToShowUserPage (user) {
      return { name: 'users.show', params: { id: user.id, slug: user.username } }
    },

    search: _.debounce(function () {
      if (this.dataset.searching) {
        this.options.search = this.dataset.search
        this.getPaginatedData(this.options)
        this.dataset.searching = false
      }
    }, 900),

    focusSearchBar () {
      this.$refs['tablesearch'].focus()
    },

    bulkTrashResource () {
      let selected = this.selected
      // axios.delete($api.destroy(null), {id})
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
