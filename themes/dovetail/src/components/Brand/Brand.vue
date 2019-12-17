<template>
  <div class="text-center mb-3">
    <v-row align="center" justify="center">
      <v-img
        class="mb-3"
        src="/logo.png"
        lazy-src="/logo.png"
        :max-width="brand"
      ></v-img>
    </v-row>
    <h3 class="mb-3">{{ __('LMS v3') }}</h3>
    <p class="text--muted">{{ __('Sign in with your Rippl3s account') }}</p>
  </div>
</template>

<script>
export default {
  data () {
    return {
      brand: 100
    }
  }
}
</script>

