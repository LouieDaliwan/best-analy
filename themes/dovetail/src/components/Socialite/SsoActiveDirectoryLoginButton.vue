<template>
  <div>
    <v-btn
      x-large block
      @click="signInToSSOAD"
      >
      <img
        :src="app.logo"
        :lazy-src="app.logo"
        class="mr-6"
        height="20"
        >
      <span class="mt-1" style="text-transform: none;">{{ $t('Sign in with Active Directory') }}</span>
    </v-btn>
  </div>
</template>

<script>
import app from '@/config/app'

export default {
  name: 'SsoActiveDirectoryLoginButton',

  props: ['value'],


  data: (vm) => ({
    app: app,
    auth: vm.value,
  }),

  methods: {
    signInToSSOAD () {
      let data = this.auth;

      axios.post(
        '/best/login/sso-ad', data
      ).then(response => {
        // console.log(response);
        this.$store.dispatch(
          'auth/login', { username: data.username, password: data.password }
        ).then(() => {
          this.$router.push({name: 'dashboard'})
          this.$store.dispatch('snackbar/show', {
            text: $t('Welcome back, ') + $auth.getUser().firstname
          })
        }).catch(err => {
          if (err.response) {
            this.$refs['signin-form'].setErrors(err.response.data.errors)
          }
        });

      });
    },
  },
}
</script>
