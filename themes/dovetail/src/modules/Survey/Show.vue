<template>
  <admin>
    <metatag :title="resource.data.title"></metatag>

    <template v-if="resource.loading">
      <skeleton-show></skeleton-show>
    </template>

    <template v-else>
      <page-header :back="{ to: { name: 'surveys.index' }, text: trans('Surveys') }">
        <template v-slot:title>{{ resource.data.title }}</template>
        <template v-slot:utilities>
          <can code="surveys.show">
            <router-link tag="a" class="dt-link text--decoration-none mr-6" exact :to="{name: 'surveys.edit'}">
              <v-icon small class="mb-1">mdi-pencil-outline</v-icon>
              {{ trans('Edit') }}
            </router-link>
          </can>
          <can code="surveys.destroy">
            <a href="#" @click.prevent="askUserToDestroyResource(resource)" class="dt-link text--decoration-none mr-6">
              <v-icon small class="mb-1">mdi-delete-outline</v-icon>
              {{ trans('Move to Trash') }}
            </a>
          </can>
        </template>
      </page-header>

      <!-- Preview Info -->
      <v-alert
        border="top"
        class="my-5"
        color="info"
        elevation="1"
        prominent
        text
        type="info"
        >
        <h2 class="mb-3 info--text">{{ __('Preview Only') }}</h2>
        <div class="dark--text">{{ __('This survey detail is for preview purposes only.') }}</div>
      </v-alert>
      <!-- Preview Info -->

      <v-card>
        <template v-for="(group, i) in resource.data['fields:grouped']">
          <v-card-text>
            <v-row justify="center">
              <v-col cols="12" md="10">
                <p class="headline py-4 mb-0 font-weight-bold">
                  {{ trans(i) }}
                </p>
                <p v-html="group[0].metadata.group_arabic"></p>
              </v-col>
              <v-col cols="12" md="10" v-for="(field, f) in group" :key="f">
                <v-row>
                  <v-col cols="12" md="auto">
                    <span class="text--text muted--text display-1 font-weight-bold">
                      {{ field.sort || 0 }}
                    </span>
                  </v-col>
                  <v-col>
                    <p class="title">{{ trans(field.title) }}</p>
                    <p class="title rtl-text">{{ trans(field.metadata.title_arabic) }}</p>
                    <p>
                      <span class="link--text mr-6">{{ __('Total Number') }}: &nbsp; {{ trans(field.metadata.total) }}</span>
                      <span class="link--text mr-6">{{ __('WTS') }}: &nbsp; {{ trans(field.metadata.wts) }}</span>
                    </p>
                    <p><span class="link--text mr-6">{{ __('Comment') }}: &nbsp; {{ trans(field.metadata.comment) }}</span></p>
                    <p class="rtl-text"><span class="link--text mr-6">{{ __('تعليق') }}: &nbsp; {{ trans(field.metadata.comment_arabic) }}</span></p>
                    <!-- Category -->
                    <p>
                      <span class="muted--text mr-6">{{ trans('Category') }}:</span>
                      <span class="link--text mr-6">
                        {{ __('Documentation') }}: &nbsp; {{ trans(field.metadata.category['Documentation'] ? field.metadata.category['Documentation'] : '-') }}
                      </span>
                      <span class="link--text mr-6">
                        {{ __('Talent') }}: &nbsp; {{ trans(field.metadata.category['Talent'] ? field.metadata.category['Talent'] : '-') }}
                      </span>
                      <span class="link--text mr-6">
                        {{ __('Technology') }}: &nbsp; {{ trans(field.metadata.category['Technology'] ? field.metadata.category['Technology'] : '-') }}
                      </span>
                      <span class="link--text">
                        {{ __('Workflow Processes') }}: &nbsp; {{ trans(field.metadata.category['Workflow Processes'] ? field.metadata.category['Workflow Processes'] : '-') }}
                      </span>
                    </p>
                    <!-- Category -->
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
          </v-card-text>
        </template>
      </v-card>
    </template>
  </admin>
</template>

<script>
import $api from './routes/api'
import Survey from './Models/Survey'
import SkeletonShow from './cards/SkeletonShow'
import { mapActions } from 'vuex'

export default {
  components: {
    SkeletonShow
  },

  data: () => ({
    api: $api,
    rates: ['0', '1', '2', '3', '4', '5'],

    resource: new Survey,
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
      this.resource.loading = true
      axios.get($api.show(this.$route.params.id))
        .then(response => {
          this.resource.data = response.data.data
          console.log(response.data.data)
        }).finally(() => { this.resource.loading = false })
    },

    askUserToDestroyResource (resource) {
      this.showDialog({
        color: 'warning',
        illustration: () => import('@/components/Icons/ManThrowingAwayPaperIcon.vue'),
        illustrationWidth: 200,
        illustrationHeight: 160,
        width: '420',
        title: trans('You are about to move to trash the selected survey.'),
        text: [trans('Some data related to survey will still remain.'), trans('Are you sure you want to deactivate and move :name to Trash?', {name: resource.data.name})],
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
          text: trans_choice('Survey successfully moved to trash', 1)
        })
        this.$router.push({ name: 'surveys.index' })
      }).catch(err => {
        this.errorDialog({
          width: 400,
          buttons: { cancel: { show: false } },
          title: trans('Whoops! An error occured'),
          text: err.response.data.message,
        })
      }).finally(() => { item.loading = false })
    },
  },

  mounted () {
    this.getResource()
  },
}
</script>
