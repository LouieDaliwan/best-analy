<template>
  <admin>
    <metatag :title="trans('All Customers')"></metatag>

    <v-row>
      <v-col cols="12">
        <v-row justify="center">
          <v-col cols="10">
            <div class="text-center mb-4">
              <h1 class="primary--text mb-1">{{ trans('Find Customer') }}</h1>
              <p class="muted--text">{{ __('Try finding a customer by its file number. It is usually 4-digits long.') }}</p>
            </div>
            <v-card class="my-10">
              <v-text-field
                :loading="searching"
                @keydown.native="search"
                autofocus
                class="dt-text-field__search"
                clear-icon="mdi-close-circle-outline"
                clearable
                height="68"
                hide-details
                label="Search file number"
                prepend-inner-icon="mdi-magnify"
                flat
                full-width
                hide-details
                solo
              ></v-text-field>
            </v-card>
          </v-col>
        </v-row>

        <div v-if="!searching && !results">
          <div class="text-center mt-9">
            <search-icon class="primary--text" style="filter: grayscale(0.7);"></search-icon>
          </div>
        </div>

        <v-slide-y-transition mode="in-out">
          <div v-if="searching">
            <v-skeleton-loader
              class="px-4 py-3 d-block"
              width="100%"
              type="table-thead, table-row@5"
            ></v-skeleton-loader>
          </div>
        </v-slide-y-transition>

        <v-data-table
          v-if="results"
          :headers="headers"
          :items="customers"
          @click:row="gotoIndexes"
          class="mt-9"
          >
          <!-- Account Name -->
          <template v-slot:item.name="{ item }">
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <a exact to="" v-on="on" v-text="item.name"></a>
              </template>
              <span>{{ trans('View Details') }}</span>
            </v-tooltip>
          </template>
          <!-- Account Name -->
        </v-data-table>
      </v-col>
    </v-row>
  </admin>
</template>

<script>
import store from '@/store'
import man from '@/components/Icons/ManOnLaptopIcon.vue'

export default {
  store,

  computed: {
    man: function () {
      console.log(man.data().svg)
      // return
    },
  },

  data: () => ({
    results: false,
    searching: false,
    headers: [
      { text: 'Company Name', align: 'left', value: 'name' },
      { text: 'File Number', align: 'left', value: 'filenum' },
      { text: 'Business Counselor Name', align: 'left', value: 'business' },
      { text: 'Date Created', align: 'left', value: 'created' },
    ],
    customers: [
      {
        name: 'Barakah Services LLC',
        filenum: '9871',
        business: 'Mohamed Albinali',
        created: '2 hours ago',
      },
      {
        name: 'Company 2',
        filenum: '5690',
        business: 'John Doe',
        created: '1 day ago',
      },
    ],
  }),

  methods: {
    search: _.debounce(function (event) {
      this.searching = true
      setTimeout(() => {
        this.results = true
        this.searching = false
      }, 1000)

    }, 920),

    gotoIndexes (any) {
      this.$router.push({name: 'customers.show', params: {id: any.filenum, customer: any}})
    }
  },

  mounted () {
    this.$store.dispatch('breadcrumbs/toggle', {show: false})
  }
}
</script>
