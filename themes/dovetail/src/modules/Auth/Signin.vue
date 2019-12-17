<template>
  <v-container fill-height>
    <v-col cols="12">
      <v-row justify="center" align="center">
        <v-col cols="12" md="6" offset-md="1" class="d-none d-md-flex order-md-2">
          <login-icon width="100%" height="100%"></login-icon>
        </v-col>

        <v-col cols="12" md="5" class="order-md-1">
          <div class="text-center">
            <brand></brand>
          </div>
          <login-form></login-form>
        </v-col>
      </v-row>
    </v-col>
  </v-container>
</template>

<script>
import LoginForm from './cards/LoginForm'
import LoginIcon from '@/components/Icons/LoginIcon'
import Brand from '@/components/Brand/Brand'

export default {
  components: {
    LoginForm,
    LoginIcon,
    Brand
  },
}
</script>


