<template>
  <admin>
    <metatag :title="resource.data.displayname"></metatag>

    <page-header :back="{name: 'users.index'}">
      <template v-slot:title>
        {{ resource.data.displayname }}
      </template>
      <template v-slot:utilities>
        <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: 'users.edit'}">
          <v-icon small class="mb-1">mdi-pencil-outline</v-icon>
          {{ trans('Edit') }}
        </router-link>
        <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: 'users.trashed'}">
          <v-icon small class="mb-1">mdi-delete-outline</v-icon>
          {{ trans('Deactivate') }}
        </router-link>
      </template>
    </page-header>

    <v-card>
      <v-card-text>
        <account :items="resource.data"></account>
      </v-card-text>

      <v-divider></v-divider>

      <!-- Background Details -->
      <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th colspan="100%" class="text-left">Background Details</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="font-weight-bold">Gender</td>
                <td>Male</td>
              </tr>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      <!-- Background Details -->
    </v-card>
  </admin>
</template>

<script>
import $api from './routes/api'
import $auth from '@/core/Auth/auth'

export default {
  data: () => ({
    api: $api,
    auth: $auth.getUser(),

    resource: {
      loading: false,
      data: {
        displayname: '',
        username: ''
      },
    }
  }),

  beforeRouteLeave: function (to, from, next) {
    // if resource.data was not save
    // then prompt user
    // something like:
    // this.$store.dispatch('snackbar/show', {show: true, text: 'Triggered on beforeRouteLeave'})

    next()
  },

  methods: {
    getResource: function () {
      axios.get($api.show(this.$route.params.id))
        .then(response => {
          this.resource.data = response.data.data
        }).finally(() => { this.resource.loading = false })
    },

    submit (e) {
      e.preventDefault()

      axios.put($api.update(this.$route.params.id), this.resource.data)
        .then(response => {
          console.log(response)
          // Toasty!
        })
        .catch(err => {
          this.resource.loading = false
          this.$refs['user-editform'].setErrors(err.response.data.errors)
        })
    },
  },

  mounted () {
    this.getResource()
  },
}
</script>
