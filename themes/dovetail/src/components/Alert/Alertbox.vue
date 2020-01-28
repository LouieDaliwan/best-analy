<template>
  <div class="dt-alertbox">
    <error-box></error-box>
    <success-box></success-box>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'Alertbox',

  methods: {
    ...mapActions({
      hideErrorbox: 'errorbox/hide',
    }),
  },

  mounted () {
    this.hideErrorbox()
  },
}
</script>
