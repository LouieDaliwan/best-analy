<template>
  <v-slide-y-transition>
    <v-card>
      <v-data-table
        :headers="dataset.headers"
        :items="dataset.items"
        :search="dataset.searchTable"
        :select-all="dataset.bulkdestroy"
        item-key="title"
        v-model="dataset.selected"
        >
        <template slot="headerCell" slot-scope="props">
          <v-tooltip bottom>
            <span slot="activator">
              {{ trans(props.header.text) }}
            </span>
          </v-tooltip>
        </template>
        <template
          slot="items"
          slot-scope="props"
          >
          <td v-if="dataset.singleCheckbox">
            <v-checkbox
              v-model="dataset.singleCheckbox"
              accent
              color="accent"
              hide-details
              >
            </v-checkbox>
          </td>
          <td v-html="props.item.id"></td>
          <td v-if="dataset.avatar">
            <v-avatar size="36">
              <img :src="props.item.thumbnail">
            </v-avatar>
          </td>
          <td class="table--ellipsis">
            <v-tooltip
              max-width="300"
              bottom
              >
              <span slot="activator" v-html="trans(props.item.title)"></span>
              <span v-html="trans(props.item.title)"></span>
            </v-tooltip>
          </td>
          <td
            v-if="dataset.category"
            v-html="trans(props.item.category)"
            >
          </td>
          <td
            class="table--ellipsis"
            v-if="dataset.slug"
            v-html="trans(props.item.slug)"
            >
          </td>
          <td
            v-if="dataset.part"
            v-html="trans(props.item.part)"
            >
          </td>
          <td
            v-if="dataset.author"
            v-html="trans(props.item.author)"
            >
          </td>
          <td
            v-if="dataset.status"
            v-html="trans(props.item.status)"
            >
          </td>
          <td
            v-if="dataset.created"
            v-html="trans(props.item.created)"
            >
          </td>
          <td
            v-if="dataset.modified"
            v-html="trans(props.item.modified)"
            >
          </td>
          <td class="layout mx-0 justify-center">
            <v-tooltip bottom>
              <v-btn slot="activator" icon>
                <v-icon
                  small
                  class="mx-3"
                  >
                  mdi-open-in-new
                </v-icon>
              </v-btn>
              <span>{{ trans('View Details') }}</span>
            </v-tooltip>
            <v-tooltip bottom>
              <v-btn slot="activator" icon>
                <v-icon
                  small
                  class="mx-3"
                  >
                  mdi-circle-edit-outline
                </v-icon>
              </v-btn>
              <span>{{ trans('Edit') }}</span>
            </v-tooltip>
            <v-tooltip bottom>
              <v-btn slot="activator" icon>
                <v-icon
                  small
                  class="mx-3"
                  >
                  mdi-delete-outline
                </v-icon>
              </v-btn>
              <span>{{ trans('Move to trash') }}</span>
            </v-tooltip>
          </td>
        </template>
        <v-card
          flat
          :value="true"
          slot="no-results"
          class="text-xs-center"
          >
          <v-card-text>
            <div class="grey--text">
              {{ trans('Your search for') }}
              "{{ __(dataset.searchTable) }}"
              {{ trans('found no results.') }}
            </div>
          </v-card-text>
        </v-card>
      </v-data-table>
    </v-card>
  </v-slide-y-transition>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,

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
