<template :dark="$store.getters['app/app'].dark">
  <!-- <v-toolbar
    flat
    :color="dataset.color"
    v-model="dataset.model"
    height="80"
    > -->
    <div class="pa-4">
      <v-row align="center" justify="space-between">
        <v-col cols="12" md="4" lg="4">
          <slot name="search">
            <v-text-field
              single-line
              prepend-inner-icon="mdi mdi-magnify"
              :placeholder="trans('Search alt+/')"
              outlined
              rounded
              dense
              hide-details
              clearable
              v-shortkey="['alt', '/']"
              ref="tablesearch"
              @shortkey.native="focus"
              @change="search"
              clear-icon="mdi-close-circle-outline"
            ></v-text-field>
          </slot>
        </v-col>
        <v-col cols="12" md="6" lg="6">
          <div class="d-flex justify-space-between justify-md-end">
            <v-btn-toggle dense rounded color="primary">
              <v-btn @click="items.toggleBulkEdit = !items.toggleBulkEdit" class="mr-3">
                <v-icon small>mdi-checkbox-marked-circle-outline</v-icon>
              </v-btn>
            </v-btn-toggle>
            <v-btn-toggle dense rounded color="primary">
              <v-btn>
                <v-icon small>mdi-download</v-icon>
              </v-btn>
              <v-dialog
                v-model="items.toggleTrash"
                width="320"
                >
                <template v-slot:activator="{ on }">
                  <v-btn v-on="on">
                    <v-icon small>mdi-delete-outline</v-icon>
                  </v-btn>
                </template>
                <v-card>
                  <man-on-laptop v-if="items.bulkCount" class="mx-auto d-block pa-5" :width="200" :height="200"></man-on-laptop>
                  <empty-icon v-else class="mx-auto d-block pa-5" :width="200" :height="200"></empty-icon>
                  <v-card-title>{{ $tc('Deactivate Selected User', items.bulkCount) }}</v-card-title>
                  <v-card-text>{{ $tc('Are you sure you want to deactivate the selected user?', items.bulkCount) }}</v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                      @click="items.trashCallback();items.toggleTrash = !items.toggleTrash"
                      color="primary"
                      text
                      v-if="items.bulkCount"
                      v-text="$tc('Okay')"
                      >
                    </v-btn>
                    <v-btn
                      @click.native="items.toggleTrash = !items.toggleTrash"
                      color="primary"
                      text
                      v-else
                      v-text="$tc('Okay')"
                      >
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-btn-toggle>
            <v-divider vertical v-if="dataset.verticaldiv"></v-divider>
            <!-- list and grid view -->
            <template v-if="dataset.listGridView">
              <!-- grid -->
              <template v-if="toolbar.toggleview">
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn
                      @click="toggleView"
                      icon
                      v-on="on"
                      >
                      <v-icon small>mdi-grid-large</v-icon>
                    </v-btn>
                  </template>
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
          </div>
        </v-col>
      </v-row>
    </div>
  <!-- </v-toolbar> -->
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
    search (val) {
      // this.$router.replace({query: {search: val}})
    },
    focus () {
      this.$refs['tablesearch'].focus()
    },
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
