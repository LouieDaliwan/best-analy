<template>
  <section>
    <metatag :title="trans('All Trashed Users')"></metatag>
    <page-header :back="{name: 'users.index'}">
      <template v-slot:utilities>
        <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: 'dashboard'}">
          <v-icon small class="mb-1">mdi mdi-delete-empty</v-icon>
          {{ trans('Deactivated') }}
        </router-link>

        <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: 'dashboard'}">
          <v-icon small class="mb-1">mdi mdi-upload</v-icon>
          {{ trans('Import') }}
        </router-link>
      </template>

      <template v-slot:action>
        <v-btn large color="primary" exact :to="{ name: 'users.create' }">
          <v-icon left>mdi mdi-account-plus-outline</v-icon>
          {{ trans("Add User") }}
        </v-btn>
      </template>
    </page-header>

    <!-- Data table -->
    <v-card>
      <toolbar-menu :items="tabletoolbar"></toolbar-menu>
      <v-divider></v-divider>
      <v-data-table
        :loading="dataset.loading"
        :headers="dataset.headers"
        :options.sync="dataset.options"
        :server-items-length="dataset.meta.total"
        :items="dataset.data"
        @update:page="goToNextOrPreviewsPage"
        @update:items-per-page="changeItemsPerPage"
        >
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
        <template v-slot:item.displayname="{ item }">
          <td class="pl-0">
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <v-icon small class="muted--text" v-on="on">mdi-home-account</v-icon>
              </template>
              <span>{{ trans('This is your account') }}</span>
            </v-tooltip>
          </td>
          <td><v-avatar size="30" color="primary"><img :src="item.avatar"></v-avatar></td>
          <td>
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <span class="muted--text" v-html="item.displayname"></span>
              </template>
              <span>{{ trans('View Details') }}</span>
            </v-tooltip>
          </td>
        </template>
        <!-- Action buttons -->
      </v-data-table>
    </v-card>
    <!-- Data table -->
  </section>
</template>

<script>
import $api from './routes/api'

export default {
  data: () => ({
    api: $api,

    dataset: {
      loading: true,
      options: {
        page: 0,
        pageCount: 0,
        itemsPerPage: 10,
        rowsPerPage: [5, 10, 15, 20, 50, 100],
      },
      meta: {},
      headers: [
        { text: trans('Account Name'), align: 'left', value: 'displayname' },
        { text: trans('Email'), value: 'email' },
        { text: trans('Role'), value: 'role', sortable: false },
        { text: trans('Created'), value: 'created' },
        { text: trans('Modified'), value: 'modified' },
        { text: trans('Actions'), value: 'action', sortable: false, class: "muted--text" },
      ],
      data: []
    },

    tabletoolbar: {
      listGridView: false,
      verticaldiv: false,
    },
  }),

  computed: {
    options: function () {
      return {
        per_page: this.dataset.options.itemsPerPage,
        page: this.dataset.options.page,
        sort: this.dataset.options.sortBy || null,
        // order: options.sortDesc,
        // search: this.dataset.search,
      }
    },
  },

  methods: {
    goToNextOrPreviewsPage (val) {
      this.getPaginatedData(this.options)
    },

    changeItemsPerPage (val) {
      this.getPaginatedData(this.options)
    },

    getPaginatedData: function (params = null) {
      params = params ? params : this.$route.query

      axios.get(this.api.trashed(), { params })
        .then(response => {
          this.dataset = Object.assign({}, this.dataset, response.data)
          this.dataset.loading = false
          this.dataset.options = Object.assign(this.dataset.options, response.data.meta, params)
          this.$router.replace({query: Object.assign({}, this.$route.query, params)}).catch(err => {})
        })
    },

    goToShowUserPage (user) {
      return { name: 'users.show', params: { id: user.id, slug: user.username } }
    },
  },

  mounted () {
    this.getPaginatedData()
  },
}
</script>
