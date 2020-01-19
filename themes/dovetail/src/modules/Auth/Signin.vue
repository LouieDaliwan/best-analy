<template>
  <v-container fill-height>
    <v-col cols="12">
      <v-row justify="center" align="center">
        <v-col cols="12" md="6" offset-md="1" class="d-none d-md-flex order-md-2">
          <!-- <login-icon class="primary--text" width="100%" height="100%"></login-icon> -->
          <div class="text-md-right" style="position: absolute; top: -20px; right: 0;">
            <img src="@/components/Illustration/how-we-work.svg" height="600" alt="">
          </div>
        </v-col>

        <v-col cols="12" md="5" class="order-md-1">
          <div class="text-center">
            <brand></brand>
          </div>

          <v-fade-transition mode="out-in">
            <login-form></login-form>
          </v-fade-transition>
        </v-col>
      </v-row>
    </v-col>
  </v-container>
</template>

<script>
import LoginForm from './cards/LoginForm'

export default {
  components: {
    LoginForm,
  },
}
</script>


