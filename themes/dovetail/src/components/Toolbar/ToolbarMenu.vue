<template>
  <!-- <v-toolbar
    flat
    :color="dataset.color"
    v-model="dataset.model"
    height="80"
    > -->
    <div class="pa-4">
      <v-row align="center" justify="space-between">
        <v-col cols="12" xs="12" md="4" lg="6">
          <slot name="search">
            <v-badge
              color="dark"
              transition="fade-transition"
              offset-y="20"
              offset-x="20"
              class="dt-badge"
              bottom
              tile
              content="/"
              v-model="$store.getters['shortkey/ctrlIsPressed']"
              >
              <v-text-field
                :append-inner-icon="items.isSearching ? 'mdi-spin mdi-loading' : 'mdi-magnify'"
                :placeholder="trans('Search...')"
                @click:clear="search"
                @keydown.native="search"
                @shortkey.native="focus"
                clear-icon="mdi-close-circle-outline"
                clearable
                dense
                hide-details
                outlined
                ref="tablesearch"
                rounded
                single-line
                v-shortkey="['ctrl', '/']"
              >
              </v-text-field>
            </v-badge>
          </slot>
        </v-col>
        <v-col cols="12" md="6" lg="6">
          <div class="d-flex justify-space-between justify-md-end">
            <v-slide-x-reverse-transition mode="in-out">
              <template v-if="items.toggleBulkEdit">
                <span class="mr-3">
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                      <v-btn v-on="on" v-if="downloadable" icon :disabled="!items.toggleBulkEdit">
                        <v-icon small>mdi-download</v-icon>
                      </v-btn>
                    </template>
                    <span>{{ trans('Export selected users') }}</span>
                  </v-tooltip>
                  <v-btn v-if="restorable" icon :disabled="!items.toggleBulkEdit">
                    <v-icon small>mdi-restore</v-icon>
                  </v-btn>
                  <v-dialog
                    v-model="items.toggleTrash"
                    width="420"
                    >
                    <template v-slot:activator="{ on }">
                      <v-tooltip bottom>
                        <template v-slot:activator="{ on: tooltip }">
                          <v-btn v-if="trashable" icon v-on="{ ...on, ...tooltip}" :disabled="!items.toggleBulkEdit">
                            <v-icon small>mdi-delete-outline</v-icon>
                          </v-btn>
                        </template>
                        <span>{{ trans('Move selected users to trash') }}</span>
                      </v-tooltip>
                    </template>
                    <v-card>
                      <div class="warning--text">
                        <man-throwing-away-paper v-if="items.bulkCount" class="mx-auto d-block pa-5" :width="240" :height="240"></man-throwing-away-paper>
                        <empty-icon v-else class="mx-auto d-block pa-5" :width="200" :height="200"></empty-icon>
                      </div>
                      <v-card-title class="pb-0">{{ $tc('Deactivate Selected User', items.bulkCount) }}</v-card-title>
                      <v-card-text>{{ $tc('Are you sure you want to deactivate the selected user?', items.bulkCount) }}</v-card-text>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn @click="items.toggleTrash = false" text color="link">
                          {{ trans('Cancel') }}
                        </v-btn>
                        <v-btn
                          :disabled="trashButtonIsLoading"
                          :loading="trashButtonIsLoading"
                          @click="emitTrashButtonClicked();toggleLoadingStateOnClick()"
                          color="warning"
                          text
                          v-if="items.bulkCount"
                          >
                          {{ $tc('Move to Trash') }}
                          <!-- <template v-slot:loader>
                            <v-slide-x-transition><v-icon dark class="mdi-spin mr-3">mdi-loading</v-icon></v-slide-x-transition>
                            <span>{{ $tc('Moving to Trash...') }}</span>
                          </template> -->
                        </v-btn>
                        <v-btn
                          @click.native="items.toggleTrash = !items.toggleTrash"
                          color="primary"
                          text
                          v-else
                          >
                          {{ $tc('Okay') }}
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </span>
              </template>
            </v-slide-x-reverse-transition>
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <v-btn-toggle v-if="bulk" v-model="items.toggleBulkEdit" dense rounded color="primary">
                  <v-btn icon v-on="on" color="primary" :value="true">
                    <v-icon v-if="items.toggleBulkEdit" color="primary" small>mdi-close</v-icon>
                    <v-icon v-else small>mdi-check-box-multiple-outline</v-icon>
                  </v-btn>
                </v-btn-toggle>
              </template>
              <span>{{ trans('Toggle multiple selection') }}</span>
            </v-tooltip>
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
    },
    bulk: {
      type: [Boolean],
    },
    downloadable: {
      type: [Boolean],
    },
    trashable: {
      type: [Boolean],
    },
    restorable: {
      type: [Boolean],
    }
  },

  data: () => ({
    dataset: {},
    trashButtonIsLoading: false,
    isSearching: false,
  }),

  methods: {
    ...mapActions({
      update: 'toolbar/update',
    }),
    search (val) {
      this.items.isSearching = true
      this.$emit('update:search', val)
    },
    focus () {
      this.$refs['tablesearch'].focus()
    },
    toggleView () {
      this.update({ toggleview: !this.toolbar.toggleview })
    },
    emitTrashButtonClicked () {
      this.$emit('update:trash')
    },
    toggleLoadingStateOnClick () {
      this.trashButtonIsLoading = !this.trashButtonIsLoading;
    },
  },
  mounted () {
    this.dataset = Object.assign({}, this.toolbar, this.items)
  },
  computed: {
    ...mapGetters({
      toolbar: 'toolbar/toolbar',
      app: 'app/app'
    }),
  },
  watch: {
    'items.toggleBulkEdit': function (val) {
      console.log(val)
      if (!val) {
        this.trashButtonIsLoading = false
        // this.toggleLoadingStateOnClick()
      }
    },
  }
}
</script>
