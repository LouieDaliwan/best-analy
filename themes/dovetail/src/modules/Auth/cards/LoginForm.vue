<template>
  <v-container grid-list-lg>
    <v-layout row wrap justify-center align-center fill-height>
      <v-flex xs12>
        <v-form
          method="POST"
          action="/login"
          >
          <v-card class="text-xs-center">
            <v-card-text>
              <v-avatar
                size="80">
                <img
                  :src="app.meta.logo"
                  >
              </v-avatar>
            </v-card-text>
            <v-card-text>
              <v-text-field
                autofocus
                label="Email Address"
                box
                id="email"
                required
                type="email"
                v-model="email"
                >
              </v-text-field>

              <v-text-field
                :append-icon="showPassword ? 'visibility_off' : 'visibility'"
                :type="showPassword ? 'text' : 'password'"
                @click:append="showPassword = !showPassword"
                autofocus
                box
                class="input-group--focused"
                id="password"
                label="Password"
                type="password"
                v-model="password"
                >
              </v-text-field>

              <v-btn
                type="submit"
                color="primary"
                @click="handleSubmit"
                >
                {{ __('Login') }}
              </v-btn>
            </v-card-text>
          </v-card>
        </v-form>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import store from '@/store'

export default {
  store,
  name: 'Login',

  data() {
    return {
      showPassword: true,
      email : "",
      password : "",
      rules: {
    }
    }
  },

  methods : {
    handleSubmit(e){
      e.preventDefault()

      if (this.password.length > 0) {
        axios.post('api/v1/login', {
          username: this.email,
          password: this.password
        })
        .then(response => {
          localStorage.setItem('user',response.data.user.fullname)
          localStorage.setItem('jwt',response.data.token)

          if (localStorage.getItem('jwt') != null){
            this.$router.push({name: 'dashboard.index'})
          }
        })
        .catch(function (error) {
          console.error(error);
        });
      }
    }
  },

  beforeRouteEnter (to, from, next) {
    if (localStorage.getItem('jwt')) {
      return next('board');
    }

    next();
  }
}
</script>
