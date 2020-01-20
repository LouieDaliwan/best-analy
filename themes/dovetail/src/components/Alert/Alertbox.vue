<template>
  <v-slide-y-transition mode="out-in">
    <v-alert
      :border="alertbox.border"
      :color="alertbox.color || alertbox.type"
      :dense="alertbox.dense"
      :dismissible="alertbox.dismissible"
      :icon="alertbox.icon"
      :outlined="alertbox.outlined"
      :prominent="alertbox.prominent"
      :type="alertbox.type"
      text
      v-model="show"
      >
      <v-row align="center">
        <v-col class="grow">
          <h3 v-if="alertbox.text" class="font-weight-bold text--text mb-4" v-text="alertbox.text"></h3>
          <slot name="utilities" v-bind:type="alertbox.type"></slot>
          <slot v-bind:type="alertbox.type">
            <ul v-if="items.length && alertbox.type === 'error'">
              <li v-for="(item, i) in items" :key="i" v-html="item"></li>
            </ul>
          </slot>
        </v-col>
      </v-row>
    </v-alert>
  </v-slide-y-transition>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Alertbox',

  props: ['list', 'type'],

  computed: {
    ...mapGetters({
      alertbox: 'alertbox/alertbox',
    }),

    show: {
      get () {
        return this.alertbox.show
      },
      set (val) {
        this.$store.dispatch('alertbox/set', { show: val })
      },
    },

    items () {
      return Object.values(this.list || this.alertbox.list).flat()
    },

    hasList () {
      return _.size(this.list)
    },
  },

  mounted () {
    this.$store.dispatch('alertbox/hide')
  },
}
</script>
