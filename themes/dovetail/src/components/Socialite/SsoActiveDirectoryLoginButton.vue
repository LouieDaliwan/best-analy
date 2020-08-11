<template>
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
</template>

<script>
import app from '@/config/app'

export default {
  name: 'SsoActiveDirectoryLoginButton',

  data: () => ({
    app: app,
  }),

  methods: {
    signInToSSOAD () {
      let data = {
        username: 'SME.Rating',
        password: null,
      }

      axios.get(
        '/best/login/sso-ad', { data }
        // `/ldap.php?username=${data.username}&password=${data.password}`
      ).then(response => {
        console.log(response);
      });
    },
  },
}
</script>
