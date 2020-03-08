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
        <v-card>
          <template v-if="resource.data.description">
            <v-card-title v-text="trans('Team Detail')"></v-card-title>
            <v-card-text>
              <p>{{ resource.data.description }}</p>
            </v-card-text>
          </template>

          <v-card-title v-text="trans('Team Manager')"></v-card-title>
          <v-card-text>
            <user-account-detail-card v-model="resource.data.lead"></user-account-detail-card>
          </v-card-text>

          <div class="d-flex">
            <v-divider></v-divider>
            <v-icon small color="muted" class="mx-3 mt-n2">mdi-account-settings</v-icon>
            <v-divider></v-divider>
          </div>

          <v-row>
            <v-col>
              <v-card-text>
                <h4 class="mb-5">{{ trans('Team Members') }}</h4>
                <treeview-field v-model="search"></treeview-field>
                <treeview-pagination
                  :items="resource.data.users"
                  :search="search"
                ></treeview-pagination>
              </v-card-text>
            </v-col>

            <v-divider vertical></v-divider>
            <v-col cols="12" md="6">

            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>
  </admin>
</template>

<script>
import $api from './routes/api'
import Team from './Models/Team'
import { mapActions } from 'vuex'

export default {
  computed: {
    filter () {
      return undefined
      // return (item, search, textKey) => item[textKey].indexOf(search) > -1
    },
  },

  data: () => ({
    api: $api,

    resource: new Team,
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
  },

  mounted () {
    this.getResource()
  },
}
</script>
