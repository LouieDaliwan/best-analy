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
      v-show="alertbox.show"
      >
      <v-row align="center">
        <v-col class="grow">
          <p v-if="alertbox.text" class="font-weight-bold text--text" v-text="alertbox.text"></p>
          <slot name="actions" v-bind:type="alertbox.type"></slot>
          <slot>
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

    items () {
      return Object.values(this.list || this.alertbox.list).flat()
    },

    hasList () {
      return _.size(this.list)
    },
  },
}
</script>
