<template>
  <div class="sticky sheet">
    <v-toolbar
      flat
      height="auto"
      >
      <v-row align="center" justify="space-between">
        <v-col cols="12" sm="4">
          <slot name="search">
            <v-badge
              bordered
              bottom
              class="dt-badge d-block"
              color="dark"
              content="/"
              offset-x="28"
              offset-y="28"
              tile
              transition="fade-transition"
              v-model="ctrlIsPressed"
              >
              <v-text-field
                :background-color="$store.getters['theme/dark'] ? 'dark' : 'workspace'"
                :placeholder="trans('Search...')"
                :prepend-inner-icon="items.isSearching ? 'mdi-spin mdi-loading' : 'mdi-magnify'"
                @click:clear="search"
                @keydown.native="search"
                @shortkey.native="focus"
                autocomplete="off"
                class="dt-text-field__search"
                clear-icon="mdi-close-circle-outline"
                clearable
                filled
                flat
                full-width
                hide-details
                ref="tablesearch"
                single-line
                solo
                v-model="items.search"
                v-shortkey="['ctrl', '/']"
              >
              </v-text-field>
            </v-badge>
          </slot>
        </v-col>
        <v-col cols="12" sm="auto">
          <div class="d-flex justify-sm-space-between justify-end align-center">
            <v-slide-x-reverse-transition>
              <div v-if="items.bulkCount" class="px-2">{{ $tc('{number} item selected', items.bulkCount, {number: items.bulkCount}) }}</div>
            </v-slide-x-reverse-transition>
            <v-slide-x-reverse-transition>
              <v-divider v-if="items.bulkCount" vertical class="mx-2"></v-divider>
            </v-slide-x-reverse-transition>
            <v-spacer v-if="items.bulkCount"></v-spacer>
            <v-scale-transition>
              <span v-if="items.toggleBulkEdit">
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn class="mr-2" v-on="on" v-if="downloadable" icon :disabled="!items.toggleBulkEdit">
                      <v-icon small>mdi-download</v-icon>
                    </v-btn>
                  </template>
                  <span>{{ trans('Export selected users') }}</span>
                </v-tooltip>
              </span>
            </v-scale-transition>
            <v-scale-transition>
              <span v-if="items.toggleBulkEdit">
                <v-btn class="mr-2" v-if="restorable" icon :disabled="!items.toggleBulkEdit">
                  <v-icon small>mdi-restore</v-icon>
                </v-btn>
              </span>
            </v-scale-transition>
            <v-scale-transition>
              <span v-if="items.toggleBulkEdit">
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn class="mr-2" @click="askUserToBulkDestroyResources" v-if="trashable" icon v-on="on" :disabled="!items.toggleBulkEdit">
                      <v-icon small>mdi-delete-outline</v-icon>
                    </v-btn>
                  </template>
                  <span>{{ trans('Move selected users to trash') }}</span>
                </v-tooltip>
              </span>
            </v-scale-transition>

            <v-badge
              bordered
              bottom
              class="dt-badge d-block"
              color="dark"
              content="shift+a"
              offset-x="30"
              offset-y="20"
              tile
              transition="fade-transition"
              v-model="ctrlIsPressed"
              >
              <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                  <v-btn-toggle v-if="bulk" v-model="items.toggleBulkEdit" dense rounded color="primary">
                    <v-btn
                      @shortkey="items.toggleBulkEdit = !items.toggleBulkEdit"
                      icon
                      v-on="on"
                      v-shortkey="['ctrl', 'shift', 'a']"
                      color="primary"
                      :value="true"
                      >
                      <v-icon v-if="items.toggleBulkEdit" color="primary" small>mdi-close</v-icon>
                      <v-icon v-else small>mdi-check-box-multiple-outline</v-icon>
                    </v-btn>
                  </v-btn-toggle>
                </template>
                <span>{{ trans('Toggle multiple selection') }}</span>
              </v-tooltip>
            </v-badge>

            <v-divider vertical v-if="dataset.verticaldiv"></v-divider>
            <!-- list and grid view -->
            <template v-if="dataset.listGridView">
              <!-- grid -->
              <template v-if="toolbar.toggleview">
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn
                      icon
                      slot="activator"
                      @click="toggleView"
                      >
                      <v-icon small>mdi-format-list-checkbox</v-icon>
                    </v-btn>
                    <span>{{ trans('Switch to List View') }}</span>
                  </template>
                </v-tooltip>
              </template>
            </template>
            <!-- list and grid view -->
          </div>
        </v-col>
      </v-row>
    </v-toolbar>
    <v-divider></v-divider>
  </div>
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
      if (this.items.bulkCount) {
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
            cancel: { show: this.items.bulkCount, color: 'link' },
            action: {
              color: this.items.bulkCount ? 'warning' : null,
              text: this.items.bulkCount ? 'Move to Trash' : 'Okay',
              callback: () => {
                this.$store.dispatch('dialog/loading', true)
                if (!this.items.bulkCount) {
                  this.$store.dispatch('dialog/loading', false)
                  this.$store.dispatch('dialog/close')
                } else {
                  this.emitTrashButtonClicked()
                }
              }
            }
          },
        })
      } else {
        this.$store.dispatch('snackbar/show', {
          text: this.$tc('Are you sure you want to deactivate the selected user?', this.items.bulkCount),
          button: {
            text: this.$t('Okay'),
          },
        })
      }
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
      ctrlIsPressed: 'shortkey/ctrlIsPressed',
      toolbar: 'toolbar/toolbar',
      app: 'app/app'
    }),
  },
  watch: {
    'items.toggleBulkEdit': function (val) {
      if (!val) {
        this.trashButtonIsLoading = false
      }
    },
  }
}
</script>
