<template>
  <v-card>
    <v-card-text>
      <div class="d-flex fill-height justify-space-between align-center">
        <div>
          <h3
            class="muted--text font-weight-regular text-uppercase mb-3"
            v-text="dataset.title"
            >
          </h3>
          <div class="d-flex align-center">
            <h1 class="font-weight-regular">
              {{ dataset.count }}
            </h1>
            <div v-if="dataset.badge" class="dt-badge dt-badge-soft-error mx-2">
              +{{ dataset.deactivated }} {{ __('Deactivated') }}
            </div>
          </div>
        </div>
        <div>
          <v-icon v-text="dataset.icon" medium class="muted--text"></v-icon>
        </div>
      </div>
    </v-card-text>
  </v-card>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'Glance',

  props: ['items'],

  data () {
    return {
      dataset: {},
    }
  },

  mounted () {
    this.dataset = Object.assign({}, this.glance, this.items)
  },

  computed: {
    ...mapGetters({
      glance: 'glance/glance'
    })
  }
}
</script>
