<template>
  <validation-observer ref="signin-form" v-slot="{ passes }">
    <v-form :disabled="loading" v-on:submit.prevent="submit">
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

      <v-btn
        type="submit"
        :disabled="loading"
        :loading="loading"
        color="primary"
        x-large block
        >
        {{ __('Sign In') }}
        <template v-slot:loader>
          <v-slide-x-transition><v-icon dark class="mdi-spin mr-3">mdi-loading</v-icon></v-slide-x-transition>
          <span>{{ 'Signing in...' }}</span>
        </template>
      </v-btn>
    </v-form>
  </validation-observer>
</template>

<script>
import $api from '@/routes/api'
import $auth from '@/core/Auth/auth'

export default {
  name: 'Login',

  data () {
    return {
      action: this.action,
      auth: {
        username: '',
        password: '',
      },
      loading: false,
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

      this.loading = true
      this.$store
        .dispatch('auth/login', { username, password })
        .then(() => {
          this.$store.dispatch('sidebar/toggle', {model: true})
          this.$router.push({name: 'dashboard'})
          this.$store.dispatch('snackbar/show', {
            text: trans('Welcome back, ') + $auth.getUser().firstname
          })
        })
        .catch(err => {
          this.loading = false
          this.$refs['signin-form'].setErrors(err.response.data.errors)
        })

      e.preventDefault()
    }
  },
}
</script>
