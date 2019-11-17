<template>
  <section>
    <v-form
      method="POST"
      @submit.prevent="updateData"
      >
      <v-card
        flat
        class="sticky emphasis--bg toolbar-mobile"
        >
        <v-container grid-list-lg>
          <v-layout row wrap justify-space-between>
            <h1 class="display-1">
              {{ __('Edit Page') }}
            </h1>
            <v-btn class="mx-0" color="secondary" type="submit">
              {{ __('Save') }}
            </v-btn>
          </v-layout>
        </v-container>
      </v-card>

      <v-container grid-list-lg>
        <v-layout row wrap>
          <v-flex md8 xs12>
            <v-text-field
              :data-vv-as="trans('Title')"
              :error-messages="errors.collect('title')"
              v-validate="'required'"
              box
              autofocus
              label="Title"
              name="title"
              v-model="resource.title"
              >
            </v-text-field>

            <v-text-field
              :data-vv-as="trans('Code')"
              :error-messages="errors.collect('code')"
              v-validate="'required'"
              box
              autofocus
              label="Code"
              name="code"
              v-model="resource.code"
              >
            </v-text-field>

            <v-textarea
              :data-vv-as="trans('Body')"
              box
              autofocus
              label="Body"
              name="body"
              v-model="resource.body"
            ></v-textarea>
          </v-flex>

          <v-flex md3 xs12>
            <v-card
              height="200"
              hover
              class="transparent upload-image emphasis--border"
              >
              <v-layout row wrap justify-center align-center fill-height>
                <v-card-text class="text-xs-center grey--text">
                  <v-icon size="50" class="text--lighten-1 grey--text">
                    mdi-google-photos
                  </v-icon>
                  <p>
                    {{ __('Click to upload photo') }}
                  </p>
                </v-card-text>
              </v-layout>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-form>
  </section>
</template>

<script>
import store from '@/store'

export default {
  store,
  name: 'Edit',

  $_veeValidate: {
    validator: 'new'
  },

  data () {
    return {
      resource: {}
    }
  },

  created() {
    axios
      .get(`/api/v1/pages/edit/${this.$route.params.id}`)
      .then((response) => {
        this.resource = response.data
      })
  },

  methods: {
    beforeFormSubmit () {
      this.$validator.reset()
      this.$validator.validateAll()
        .then(ok => {
          if (ok) {
            this.updateData()
          }
        })
    },

    updateData () {
      axios
        .post('/api/v1/pages/update/' + this.$route.params.id, this.resource)
        .then((response) => {
          this.$router.go({name: 'pages.edit'});
          alert('submitted');
        })
    },
  },
}
</script>
