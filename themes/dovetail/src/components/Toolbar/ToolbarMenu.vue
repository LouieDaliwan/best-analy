<template :dark="$store.getters['app/app'].dark">
  <v-toolbar
    flat
    :color="dataset.color"
    v-model="dataset.model"
    >

    <v-col cols="12" xs="12" sm="12" md="6" lg="4">
      <v-text-field
        single-line
        prepend-inner-icon="mdi mdi-magnify"
        placeholder="Search (''ctrl + /'' to focus)"
        filled
        rounded
        dense
        hide-details
        clearable
        clear-icon="mdi mdi-close-circle-outline"
      ></v-text-field>
    </v-col>

    <v-spacer></v-spacer>

    <v-divider vertical></v-divider>

    <!-- Bulk select -->
    <!-- Bulk export -->
    <!-- Bulk trash -->

    <!-- list and grid view -->
    <template v-if="dataset.listGridView">
      <!-- grid -->
      <template v-if="toolbar.toggleview">
        <v-tooltip
          bottom
          >
          <v-btn
            @click="toggleView"
            icon
            slot="activator"
            >
            <v-icon small>mdi-grid-large</v-icon>
          </v-btn>
          <span>{{ trans('Switch to Grid View') }}</span>
        </v-tooltip>
      </template>
      <!-- list -->
      <template v-else>
        <v-tooltip
          bottom
          >
          <v-btn
            icon
            slot="activator"
            @click="toggleView"
            >
            <v-icon small>mdi-format-list-checkbox</v-icon>
          </v-btn>
          <span>{{ trans('Switch to List View') }}</span>
        </v-tooltip>
      </template>
    </template>
    <!-- list and grid view -->
  </v-toolbar>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
  name: 'ToolbarMenu',

  props: {
    items: {
      type: [Object, Array],
      default: () => {
        return {}
      }
    }
  },

  data () {
    return {
      dataset: {}
    }
  },

  methods: {
    ...mapActions({
      update: 'toolbar/update',
      bulk: 'dataset/update',
    }),

    toggleView () {
      this.update({ toggleview: !this.toolbar.toggleview })
    },

    clickbulk () {
      this.update({ showBulk: !this.dataset.showBulk })
      console.log('test')
    },
  },

  mounted () {
    this.dataset = Object.assign({}, this.toolbar, this.items)
  },

  computed: {
    ...mapGetters({
      toolbar: 'toolbar/toolbar',
      app: 'app/app'
    })
  }
}
</script>
