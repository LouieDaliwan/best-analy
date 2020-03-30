<template>
  <v-tabs v-model="tab" :vertical="isDesktop" class="dt-tabs" background-color="transparent">
    <v-tab key="tab-0">{{ trans('Company Information') }}</v-tab>
    <v-tab key="tab-1">{{ trans('Financial Statements') }}</v-tab>
    <slot name="item"></slot>
  </v-tabs>
</template>

<script>
  export default {
    computed: {
      tab: {
        get () {
          return this.value
        },
        set (val) {
          this.$emit('input', val)
        },
      },

      isDesktop () {
        return this.$vuetify.breakpoint.mdAndUp
      },
    },

    props: ['value'],
  }
</script>
