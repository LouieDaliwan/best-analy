<template>
  <section>
    <metatag :title="resource.data.displayname"></metatag>

    <page-header :back="{name: 'users.index'}"></page-header>

    <div>users.show</div>
    <v-card>
      <v-card-text>
        <div class="pb-4 mb-4">Fields goes here</div>

        <div class="pb-4">
          <v-avatar size="40" color="primary"><img :src="resource.data.avatar"></v-avatar>
        </div>

        <form ref="user-editform" @submit.prevent="submit">
          <v-text-field outlined :label="trans('First name')" name="firstname" v-model="resource.data.firstname"></v-text-field>
          <div class="pb-4 mb-4"><em>...etc</em></div>
          <v-btn :disabled="resource.loading" :loading="resource.loading" type="submit">Save</v-btn>
        </form>

        <div class="pb-4 mb-4"></div>
        User object retrieved from <code>/api/v1/users/{{ $route.params.id }}</code>:

        <div><code>resource.</code></div>
        <code style="width:100%">{{ resource }}</code>
      </v-card-text>
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
