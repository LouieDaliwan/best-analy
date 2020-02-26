<template>
  <admin>
    <metatag :title="trans('My Companies')"></metatag>

    <page-header>
      <template v-slot:title>
        <div class="mt-1">{{ __('My Companies') }}</div>
      </template>
      <template v-slot:action>
        <v-btn large color="primary" exact :to="{ name: 'companies.generate' }">
          <v-icon small left>mdi-file-document-box-search-outline</v-icon>
          {{ trans('Generate Report') }}
        </v-btn>
      </template>
    </page-header>

    <!-- Data table -->
    <v-card>
      <toolbar-menu
        :items.sync="tabletoolbar"
        downloadable
        trashable
        @update:search="search"
        >
      </toolbar-menu>
      <v-slide-y-reverse-transition mode="out-in">
        <v-data-table
          :headers="dataset.headers"
          :items="dataset.data"
          :loading="dataset.loading"
          :mobile-breakpoint="NaN"
          :options.sync="dataset.options"
          :server-items-length="dataset.meta.total"
          :show-select="tabletoolbar.toggleBulkEdit"
          @update:options="optionsChanged"
          color="primary"
          item-key="id"
          v-model="dataset.selected"
          >
          <template v-slot:progress><span></span></template>

          <template v-slot:loading>
            <v-slide-y-transition mode="out-in">
              <div>
                <div class="d-flex" v-for="(j,i) in dataset.options.itemsPerPage" :key="i">
                  <v-skeleton-loader
                    class="px-4 py-3"
                    width="100%"
                    type="table-row"
                  ></v-skeleton-loader>
                </div>
              </div>
            </v-slide-y-transition>
          </template>

          <template v-slot:item.name="{ item }">
            <div class="d-flex align-items-center">
              <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                  <span class="mt-1" v-on="on"><router-link tag="a" exact :to="goToShowCompanyPage(item)" v-text="item.name" class="text-no-wrap text--decoration-none"></router-link></span>
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
        </v-data-table>
      </v-slide-y-reverse-transition>
    </v-card>
    <!-- Data table -->
  </admin>
</template>

<script>
import $api from './routes/api'
import man from '@/components/Icons/ManThrowingAwayPaperIcon.vue'

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
      },
      meta: {},
      headers: [
        { text: trans('Name'), align: 'left', value: 'name', class: 'text-no-wrap' },
        { text: trans('Reference Number'), value: 'refnum', class: 'text-no-wrap' },
        { text: trans('Status'), value: 'status', class: 'text-no-wrap' },
        { text: trans('Last Modified'), align: 'center', value: 'updated_at', class: 'text-no-wrap' },
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
      params = Object.assign(params ? params : this.$route.query, { search: this.dataset.search })
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
            color: 'error',
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

    goToShowCompanyPage (company) {
      return { name: 'companies.show', params: { id: company.id, slug: company.companyname } }
    },

    search: _.debounce(function (event) {
      this.dataset.search = event.srcElement.value || ''
      this.tabletoolbar.isSearching = false
      if (this.dataset.searching) {
        this.getPaginatedData(this.options, 'search')
        this.dataset.searching = false
      }
    }, 200),

    focusSearchBar () {
      this.$refs['tablesearch'].focus()
    },
  },

  watch: {
    'dataset.search': function (val) {
      this.dataset.searching = true
    },
  },
}
</script>
