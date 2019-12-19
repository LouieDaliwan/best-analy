<template>
  <v-fade-transition mode="in-out">
    <v-card>
      <v-data-table
        v-model="selected"
        :headers="headers"
        :items="datasets"
        :single-select="singleSelect"
        item-key="name"
        show-select
        >
        <template v-slot:top>
          <v-switch v-model="singleSelect" label="Single select" class="pa-3"></v-switch>
        </template>
      </v-data-table>
    </v-card>
  </v-fade-transition>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'DataTable',

  props: {
    width: {
      type: [Number, String],
      default: 120
    },
    height: {
      type: [Number, String],
      default: 120
    },
    items: {
      type: [Object, Array],
      default: () => {
        return {
        }
      }
    }
  },

  data () {
    return {
      dataset: {},
    }
  },

  mounted () {
    this.dataset = Object.assign({}, this.datatable, this.items)
  },

  components: {},

  computed: {
    ...mapGetters({
      datatable: 'datatable/datatable',
      bulk: 'toolbar/toolbar',
    })
  },
  methods: {}
}
</script>
