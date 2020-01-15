<template>
  <section>
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
        <v-row justify="center" align="center">
          <v-col cols="12" md="4">
            <div class="d-flex justify-center align-center">
              <div class="dt-avatar-preview">
                <v-avatar size="160">
                  <img :src="resource.data.avatar" alt="">
                </v-avatar>
              </div>
            </div>
          </v-col>
          <v-col cols="12" md="8">
            <h2 class="mb-3">{{ resource.data.displayname }}</h2>
            <div class="muted--text mb-2">
              <v-icon small class="mr-2 muted--text">mdi-at</v-icon>
              {{ resource.data.username }}
            </div>
            <div class="muted--text mb-2">
              <v-icon small class="mr-2 muted--text">mdi-email-outline</v-icon>
              {{ resource.data.email }}
            </div>
            <div class="muted--text">
              <v-icon small class="mr-2 muted--text">mdi-account-outline</v-icon>
              Super Administrator
            </div>
          </v-col>
        </v-row>
      </v-card-text>

      <v-divider></v-divider>

      <!-- Background Details -->
      <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th colspan="2" class="text-left">Background Details</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="font-weight-bold">Gender</td>
                <td>Male</td>
              </tr>
              <tr>
                <td class="font-weight-bold">Mobile Phone</td>
                <td>+639 15 223 22 45</td>
              </tr>
              <tr>
                <td class="font-weight-bold">Home Address</td>
                <td>Manila, Philippines</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      <!-- Background Details -->
    </v-card>
  </section>
</template>

<script>
import $api from './routes/api'

export default {
  data: () => ({
    resource: {
      loading: false,
      data: {},
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
