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
                prepend-inner-icon="mdi-magnify"
                clear-icon="mdi-close-circle-outline"
                clearable
                dense
                solo
                class="dt-text-field__search"
                :background-color="$store.getters['theme/dark'] ? 'dark' : 'workspace'"
                filled
                flat
                hide-details
                data-xoutlined
                ref="tablesearch"
                data-xrounded
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
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                      <v-btn @click="askUserToBulkDestroyResources" v-if="trashable" icon v-on="on" :disabled="!items.toggleBulkEdit">
                        <v-icon small>mdi-delete-outline</v-icon>
                      </v-btn>
                    </template>
                    <span>{{ trans('Move selected users to trash') }}</span>
                  </v-tooltip>
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
import ManIcon from '@/components/Icons/ManThrowingAwayPaperIcon.vue'
import EmptyIcon from '@/components/Icons/EmptyIcon.vue'

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
    askUserToBulkDestroyResources () {
      this.$store.dispatch('dialog/prompt', {
        show: true,
        width: 420,
        illustration: this.items.bulkCount ? ManIcon : EmptyIcon,
        illustrationWidth: 240,
        illustrationHeight: 240,
        loading: this.trashButtonIsLoading,
        color: 'warning',
        title: this.$tc('Deactivate Selected User', this.items.bulkCount),
        text: this.$tc('Are you sure you want to deactivate the selected user?', this.items.bulkCount),
        buttons: {
          cancel: { show: true, color: 'link' },
          action: {
            color: this.items.bulkCount ? 'warning' : null,
            text: this.items.bulkCount ? 'Move to Trash' : 'Okay',
            callback: (dialog) => {
              dialog.loading = true
              this.emitTrashButtonClicked()
            }
          }
        },
      })
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
