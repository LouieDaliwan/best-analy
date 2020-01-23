<template>
  <v-alert
    :border="successbox.border"
    :color="successbox.color || successbox.type"
    :dense="successbox.dense"
    :dismissible="successbox.dismissible"
    :icon="successbox.icon"
    :outlined="successbox.outlined"
    :prominent="successbox.prominent"
    :type="successbox.type"
    text
    v-model="show"
    >
    <v-row align="center">
      <v-col class="grow">
        <div v-if="successbox.text" class="font-weight-bold text--success mb-4" v-text="successbox.text"></div>
        <slot>
          <can :code="successbox.buttons.show.to">
            <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: successbox.buttons.show.to, params: { id: $route.params.id }}">
              <v-icon small left>{{ successbox.buttons.show.icon }}</v-icon>
              {{ trans(successbox.buttons.show.text) }}
            </router-link>
          </can>
          <can :code="successbox.buttons.create.to">
            <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: successbox.buttons.create.to}">
              <v-icon small left>{{ successbox.buttons.create.icon }}</v-icon>
              {{ trans(successbox.buttons.create.text) }}
            </router-link>
          </can>
        </slot>
      </v-col>
    </v-row>
  </v-alert>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'SuccessBox',

  computed: {
    ...mapGetters({
      successbox: 'successbox/successbox',
    }),

    show: {
      get () {
        return this.successbox.show
      },
      set (val) {
        this.$store.dispatch('successbox/set', { show: val })
      },
    },
  }
}
</script>
