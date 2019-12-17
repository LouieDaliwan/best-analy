<template>
  <v-container grid-list-lg>
    <validation-observer ref="signin-form" v-slot="{ passes }">
      <form v-on:submit.prevent="submit">
        <validation-provider name="username" rules="required" v-slot="{ errors }">
          <v-text-field
            :error-messages="errors"
            :label="trans('Username or email')"
            autofocus
            class="mb-3"
            outlined
            v-model="auth.username"
            clear-icon="mdi mdi-close-circle-outline"
            clearable
          ></v-text-field>
        </validation-provider>

        <validation-provider name="password" rules="required" v-slot="{ errors }">
          <v-text-field
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            :error-messages="errors"
            :label="trans('Password')"
            :type="showPassword ? 'text' : 'password'"
            @click:append="showPassword = !showPassword"
            class="mb-3"
            clear-icon="mdi mdi-close-circle-outline"
            clearable
            outlined
            password
            v-model="auth.password"
          ></v-text-field>
        </validation-provider>
        <v-btn type="submit" color="primary" x-large block>{{ trans('Sign in') }}</v-btn>
      </form>

    </validation-observer>
  </v-container>
</template>

<script>
import store from '@/store'
import $api from '@/routes/api'

export default {
  store,

  name: 'Login',

  data () {
    return {
      action: this.action,
      auth: {
        username: '',
        password: '',
      },
      showPassword: false,
    }
  },

  computed: {
    isMobile: function () {
      return this.$vuetify.breakpoint.smAndDown;
    }
  },

  methods: {
    submit (e) {
      const { username, password } = this.auth

      this.$store
        .dispatch('auth/login', { username, password })
        .then(() => this.$router.push({name: 'dashboard'}))
        .catch(err => this.$refs['signin-form'].setErrors(err.response.data.errors))

      e.preventDefault()
    }
  },
}
</script>
