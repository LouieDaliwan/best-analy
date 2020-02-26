<template>
  <admin>
    <metatag :title="trans('Find Company')"></metatag>

    <v-row>
      <v-col cols="12">
        <v-row justify="center">
          <v-col cols="10">
            <div class="text-center mb-4">
              <v-scale-transition>
                <h1 v-if="companyFound" class="primary--text mb-1">{{ trans('Company Found!') }}</h1>
                <h1 v-else class="primary--text mb-1">{{ trans('Find Company') }}</h1>
              </v-scale-transition>
              <p class="muted--text">{{ trans('Try finding a company by its file number. It is usually 5-digits long.') }}</p>
            </div>
            <v-card class="my-10">
              <v-text-field
                :label="trans('Search file number')"
                :loading="searching"
                @keydown.native="search"
                autofocus
                class="dt-text-field__search"
                clear-icon="mdi-close-circle-outline"
                clearable
                flat
                full-width
                height="68"
                hide-details
                prepend-inner-icon="mdi-magnify"
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
          :items="companies"
          class="mt-9"
          >
          <!-- Actions -->
          <template v-slot:item.actions="{ item }">
            <v-btn @click.prevent="goToNextStep" color="primary">{{ trans('Start') }}</v-btn>
          </template>
          <!-- Actions -->
        </v-data-table>
      </v-col>
    </v-row>
  </admin>
</template>

<script>
import $api from './routes/api'
import $auth from '@/core/Auth/auth'
import store from '@/store'
import { CRM_CODE_FILE_NUMBER_DOES_NOT_EXIST } from './config/crm'
import { mapActions } from 'vuex'

export default {
  store,

  data: () => ({
    results: false,
    searching: false,
    companyFound: false,
    query: '',
    errors: [],
    headers: [
      { text: 'Company Name', align: 'left', value: 'CompanyName' },
      { text: 'Funding Request No.', align: 'left', value: 'FundingRequestNo' },
      { text: 'Business Counselor Name', align: 'left', value: 'BusinessCounselorName' },
      { text: 'Status', align: 'left', value: 'Status' },
      { text: '', align: 'left', value: 'actions' },
    ],
    companies: [],
  }),

  methods: {
    ...mapActions({
      loadDialog: 'dialog/loading',
      showDialog: 'dialog/show',
      hideDialog: 'dialog/hide',
      showSnackbar: 'snackbar/show',
      hideSnackbar: 'snackbar/hide',
      toggleBreadcrumbs: 'breadcrumbs/toggle',
    }),

    search: _.debounce(function (event) {
      this.query = event.srcElement.value || ''
      this.searching = true
      this.companyFound = false

      if (!_.isEmpty(this.query)) {
        this.searchForCompanyInCrm(this.query)
      }

      // Set a timeout for the search
      // flag for unexpected hangs.
      setTimeout(() => {
        this.searching = false
      }, 3000)
    }, 920),

    searchForCompanyInCrm (query) {
      axios.get(
        $api.crm.search(query)
      ).then(response => {
        let { Code, Message, Content } = response.data

        if (Code == CRM_CODE_FILE_NUMBER_DOES_NOT_EXIST) {
          this.errors.push(Message)
          return this.showSnackbar({
            text: this.trans(Message)
          })
        }

        if (Code == CRM_CODE_FILE_NUMBER_FOUND) {
          this.companyFound = true
          this.results = true
          this.companies.push(Content)
        }

      }).catch((err) => {
        this.showDialog({
          illustration: () => import('@/components/Icons/ErrorIcon.vue'),
          title: trans('Internal Error'),
          text: trans('Incorrect file number input. Please try again.'),
          buttons: {
            cancel: false
          }
        })
      }).finally(() => {
        this.searching = false
      })
    },

    goToNextStep () {
      this.saveFoundCompany(this.companies[0])
    },

    saveFoundCompany (data) {
      let attributes = {
        name: data.CompanyName,
        code: this.slugify(data.CompanyName),
        refnum: data.Id,
        status: data.Status,
        token: data.Id,
        user_id: $auth.getId(),
        metadata: {
          FundingRequestNo: data.FundingRequestNo,
          BusinessCounselorName: data.BusinessCounselorName,
        },
      }

      axios.post(
        $api.crm.update(), attributes
      ).then(response => {
        this.showSnackbar({
          text: trans('Company successfully saved'),
        })
        this.goToCompanyShowPage(response.data.id)
      })
    },

    goToCompanyShowPage (id) {
      this.$router.push({name: 'companies.show', params: {id: id}})
    }
  },

  mounted () {
    this.toggleBreadcrumbs({show: false})
  }
}
</script>
