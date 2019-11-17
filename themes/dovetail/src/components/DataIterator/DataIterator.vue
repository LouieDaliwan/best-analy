<template>
  <v-slide-y-transition>
   <!--  <v-text-field
      append-icon="search"
      hide-details
      label="Search"
      single-line
      v-model="dataset.search"
    ></v-text-field> -->
    <v-data-iterator
      :items="dataset.items"
      :pagination.sync="dataset.pagination"
      :rows-per-page-items="dataset.rowsPerPageItems"
      content-tag="v-layout"
      row
      wrap
      :search="dataset.search"
      >
      <v-flex
        :lg2="dataset.lg2"
        :lg3="dataset.lg3"
        :md2="dataset.md2"
        :md3="dataset.md3"
        :md4="dataset.md4"
        :sm6="dataset.sm6"
        :xs12="dataset.xs12"
        slot-scope="props"
        slot="item"
        >
        <v-card
          :class="dataset.cardClass"
          :height="dataset.cardHeight"
          :hover="dataset.hover"
          :href="dataset.hover ? dataset.cardLink : ''"
          >
          <v-tooltip bottom>
            <v-img
              :class="dataset.cardMediaClass"
              :height="dataset.cardMediaHeight"
              :src="props.item.thumbnail"
              slot="activator"
              >
              <v-layout
                fill-height
                align-end
                class="ma-2"
                justify-end
                row
                v-if="dataset.chip"
                >
                <v-card-text class="text-xs-right">
                  <v-chip
                    class="pb-1 elevation-2"
                    color="secondary"
                    dark
                    small
                    text-color="white"
                    v-if="props.item.status"
                    >
                    {{ props.item.status }}
                  </v-chip>
                </v-card-text>
              </v-layout>
            </v-img>
            <span v-html="trans(props.item.title)"></span>
          </v-tooltip>

          <!-- media-title -->
          <v-toolbar
            :class="dataset.toolbarClass"
            :flat="dataset.toolbarFlat"
            v-if="dataset.showToolbar"
            >
            <v-toolbar-title>
              <v-tooltip
                bottom
                >
                <span
                  :class="dataset.toolbarTitleClass"
                  slot="activator"
                  v-html="trans(props.item.title)"
                  >
                </span>
                <span v-html="trans(props.item.title)"></span>
              </v-tooltip>

              <div
                :class="dataset.fileSizeClass"
                v-html="props.item.size"
                >
              </div>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-tooltip bottom>
              <v-menu
                bottom
                left
                slot="activator"
                >
                <v-btn
                  slot="activator"
                  icon
                  ripple
                  >
                  <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list dense>
                  <v-list-tile
                    ripple
                    >
                    <v-list-tile-avatar>
                      <v-icon color="warning">delete</v-icon>
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                      <v-list-tile-title>{{ trans('Move to Trash') }}</v-list-tile-title>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile
                    ripple
                    >
                    <v-list-tile-avatar>
                      <v-icon color="error">delete_forever</v-icon>
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                      <v-list-tile-title>{{ trans('Delete Permanently') }}</v-list-tile-title>
                    </v-list-tile-content>
                  </v-list-tile>
                </v-list>
              </v-menu>
              <span>{{ trans('More Actions') }}</span>
            </v-tooltip>
          </v-toolbar>
          <!-- media-title -->

          <!-- card-text -->
          <v-card-text
            v-if="dataset.showCardText"
            >
            <p
              class="body-2 mb-2 primary--text">
              <strong v-html="trans(props.item.category)"></strong>
            </p>
            <v-tooltip bottom>
              <h3
                slot="activator"
                class="subheading font-weight-bold mb-3 text-truncate"
                v-html="trans(props.item.title)"
                >
              </h3>
              <span v-html="trans(props.item.title)"></span>
            </v-tooltip>
            <p>
              <span
                class="text--ellipsis"
                v-html="trans(props.item.description)"
                >
              </span>
            </p>
          </v-card-text>
          <!-- card-text -->

          <v-card-actions
            bottom
            class="grey--text pa-3"
            v-if="dataset.cardActions"
            >
            <span
              class="body-1"
              v-html="props.item.timestamp"
              >
            </span>
            <v-spacer></v-spacer>
            <!-- part -->
            <span
              class="body-1"
              v-if="dataset.showPart"
              >
              <span v-html="trans(props.item.part)"></span>
              <span> Parts</span>
            </span>
            <!-- part -->

            <!-- mimetype -->
            <span
              class="body-1"
              v-if="dataset.showMimetype"
              >
              <v-tooltip
                bottom
                >
                <span slot="activator">
                  <v-icon
                    class="grey--text"
                    v-html="props.item.icon"
                    >
                  </v-icon>
                </span>
                <span v-html="trans(props.item.mimetype)"></span>
              </v-tooltip>
            </span>
            <!-- mimetype -->
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-data-iterator>
  </v-slide-y-transition>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'DataIterator',

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

  mounted () {
    this.dataset = Object.assign({}, this.dataiterator, this.items)
  },

  computed: {
    ...mapGetters({
      dataiterator: 'dataiterator/dataiterator'
    })
  },
  methods: {
    show () {
      this.$store.dispatch('dataiterator/PROMPT_DIALOG', { model: true })
    },

    hide () {
      this.$store.dispatch('dataiterator/PROMPT_DIALOG', { model: false })
    }
  }
}
</script>
